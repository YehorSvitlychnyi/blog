<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';


    public static function getLikes(string $postId)
    {
        return self::all()->where('post_id','=', $postId)->where('liked', '=', '1')->count();
    }
    public static function getDislikes(string $postId)
    {
        return self::all()->where('post_id','=', $postId)->where('liked', '=', '0')->count();
    }
}
