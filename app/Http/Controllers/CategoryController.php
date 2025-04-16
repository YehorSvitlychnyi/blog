<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request )
    {
        $categories = Category::all();
        $data = $request->validated();
        $category = new Category();
        $category->parent_id = $data['parent_category'];
//        dump($data['parent_category']);
        $prefix = '';
//        if($data['parent_category'] !== null){
//            $parent_id = $data['parent_category'];
//            while($parent_id !== null){
//                $prefix = $prefix . '-';
//                foreach($categories as $category){
//                    $id = &$parent_id;
//                    if($category->id == $id){
//                        $id = $category->parent_id;
//                        dump($category->parent_id);
//                    }
//                }
//            }
//        }
        $category->name = $prefix . $data['category'];
//        dd($category->parent_id, $data['parent_category'], $category->name, $data['category']);
        $category->save();
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
