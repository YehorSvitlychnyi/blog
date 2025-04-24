<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Posts_Categories;
use App\Models\Rating;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        $posts->map(function ($post) {
            $post->likes_count = Rating::getLikes($post->id);
            $post->disLikes_count = Rating::getDislikes($post->id);
        });
        return view('main', ['posts' => $posts]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormRequest $request)
    {
        $data = $request->validated();
        $image = $data['file'];
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->StoreAs('/images', $imageName ,'public');
        $post = new Post();
        $post->name = $data['title'];
        $post->author_id = Auth::id();
        $post->short_description = $data['short_description'];
        $post->description = $data['description'];
        $post->img_link = $imagePath;
        if (!isset($data['comments'])) {
            $post->comment_enabled = 0;
        }
        $post->save();
        $this->savePostsCategories($data['categories'], $post->id);
        return redirect()->route('my_blog');
    }
    public function savePostsCategories($categories, $postId) : void
    {
        $bigArray = [];
        foreach ($categories as $category) {
            $id = $category;
            $ctgs = Category::all();
            $parent_id = null;
            foreach ($ctgs as $ctg){
                if($ctg->id == $id){
                    $parent_id = $ctg->parent_id;
                }
            }
            if ($parent_id === null) {
                $bigArray[] = $category;
            } else {
                $array = $this->getCategoriesId($parent_id);
                $array[] = $category;
                $bigArray = array_merge($bigArray, $array);
            }
        }
        $bigArray = array_unique($bigArray,SORT_REGULAR);
        foreach ($bigArray as $value){
            $postCategory = new Posts_Categories();
            $postCategory->post_id = $postId;
            $postCategory->category_id = $value;
            $postCategory->save();
        }
    }
    public function getCategoriesId($parent_id) : array
    {
        $categories = Category::all();
        $parent_categories = [];
        while($parent_id !== null){
            foreach($categories as $category){
                if($category->id == $parent_id){
                    $parent_id = $category->parent_id;
                    array_unshift($parent_categories, $category->id);
                    break;
                }
            }
        }
        return $parent_categories;
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $likes = Rating::getLikes($post->id);
        $dislikes = Rating::getDislikes($post->id);
        $comments = Comment::all()->where('post_id', '=', $post->id)->sortByDesc('created_at');
        $status = Rating::getStatus($post->id, Auth::id());
        if ($status === false){
            $like = null;
            $dislike = null;
        }elseif ($status === 0){
            $like = null;
            $dislike = 1;
        }else{
            $like = 1;
            $dislike = null;
        }
        return view('post.show',
            [
                'post' => $post,
                'likes' => $likes,
                'dislikes' => $dislikes,
                'comments' => $comments,
                'like' => $like,
                'dislike' => $dislike,
            ]);
    }
    public function myBlog()
    {
        $posts = Post::where('author_id', Auth::id())->latest()->paginate(6);
        $posts->map(function ($post) {
            $post->likes_count = Rating::getLikes($post->id);
            $post->disLikes_count = Rating::getDislikes($post->id);
        });
        return view('blog', ['posts' => $posts ]);
    }

    /**
     * @param string $id
     *
     * @return View
     */
    public function edit(Post $post): View
    {
        return view('post.edit', [
            'post' => $post,
            'categories' => \App\Models\Category::all(),
        ]);
    }

    /**
     * @param StoreFormRequest $request
     * @param string           $id
     *
     * @return RedirectResponse
     */
    public function update(StoreFormRequest $request, Post $post): RedirectResponse
    {
//        if($request->user()->cannot('update', $post)){
//            abort(403);
//        }
        $data = $request->validated();
        $post->name = $data['title'];
        $post->short_description = $data['short_description'];
        $post->description = $data['description'];

        if ($request->hasFile('img_link')) {
            $image = $request->file('img_link');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->StoreAs('/images', $imageName ,'public');
            $post->img_link = $imagePath;
        }

        $post->save();
        $post->categories()->sync($data['categories']);

        return redirect()->route('my_blog');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->author_id !== Auth::id()) {
            abort(403, 'Ви не маєте прав для видалення цього поста.');
        }

        $post->categories()->detach();

        if ($post->img_link) {
            Storage::disk('public')->delete($post->img_link);
        }
        Comment::deleteAll($post->id);
        Rating::deleteAll($post->id);
        $post->delete();

        return redirect()->route('my_blog')->with('success', 'Success');
    }
}
