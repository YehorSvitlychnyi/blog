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
        'password',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'posts_categories');
    }

}
