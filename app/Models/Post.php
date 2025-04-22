<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'author_id',
        'name',
        'img_link',
        'short_description',
        'description',
        'comment_enabled',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'posts_categories');
    }
    public function user(){
        return $this->belongsTo(User::class, 'author_id');
    }
}
