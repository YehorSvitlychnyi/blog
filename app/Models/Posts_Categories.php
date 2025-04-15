<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts_Categories extends Model
{
    protected $table = 'posts_categories';
    protected $fillable = [
        'post_id',
        'category_id',
    ];
    public $timestamps = false;
}
