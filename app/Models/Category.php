<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_categories');
    }


}
