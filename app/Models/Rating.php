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
    public static function getStatus(string $postId, string $userId)
    {
        $status = self::all()->where('post_id','=', $postId)->where('user_id', '=', $userId)->first();
        if($status){
            return $status->liked;
        }
        return false;
    }
    public static function deleteAll(string $post_id)
    {
        foreach (self::all()->where('post_id', $post_id) as $rating){
            $rating->delete();
        }
    }
}
