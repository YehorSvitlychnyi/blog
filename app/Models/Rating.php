<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';


    public function getLikes(string $postId)
    {
        return $this->all()->where('post_id','=', $postId)->where('liked', '=', '1')->count();
    }
    public function getDislikes(string $postId)
    {
        return $this->all()->where('post_id','=', $postId)->where('liked', '=', '0')->count();
    }
}
