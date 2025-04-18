<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/main', [PostController::class, 'index'])->name('post.index');

Route::get('/blog', function () {
    return view('blog');
})->name('my_blog');

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');

Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::get('/category/create',[\App\Http\Controllers\CategoryController::class,'create'])->name('category.create');
Route::post('/category',[\App\Http\Controllers\CategoryController::class,'store'])->name('category.store');

Route::get('/post/{post}',[PostController::class,'show'])->name('post.show');
Route::get('/blog', [PostController::class, 'myBlog'])->middleware('auth')->name('my_blog');
Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::post('/comment/{post}', [CommentController::class, 'store'])->name('comment.store');
Route::get('/comment/{comment}', [CommentController::class, 'edit'])->name('comment.edit');
Route::patch('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

