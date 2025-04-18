<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Posts_Categories;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('main', compact('posts'));
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
        $comments = Comment::all()->where('post_id', '=', $post->id);
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
        return view('blog', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
         //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post->author_id !== Auth::id()) {
            abort(403, 'Ви не маєте прав для видалення цього поста.');
        }

        $post->categories()->detach();

        if ($post->img_link) {
            Storage::disk('public')->delete($post->img_link);
        }
        Comment::deleteAll($id);
        $post->delete();

        return redirect()->route('my_blog')->with('success', 'Пост успішно видалено.');
    }
}
