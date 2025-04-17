<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Posts_Categories;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(!isset($data['comments'])){
            $post->comment_enabled = 0;
        }
        $post->save();
        $categories = $data['categories'];
        foreach($categories as $category){
            $postCategory = new Posts_Categories();
            $postCategory->post_id = $post->id;
            $postCategory->category_id = $category;
            $postCategory->save();
        }
        return redirect()->route('my_blog');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $rating = new Rating();
        $likes = $rating->getLikes($post->id);
        $dislikes = $rating->getDislikes($post->id);
        return view('post.show',
            [
                'post' => $post,
                'likes' => $likes,
                'dislikes' => $dislikes,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
        //
    }
}
