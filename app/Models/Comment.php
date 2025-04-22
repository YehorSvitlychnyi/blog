<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'comment',
    ];
    public static function deleteAll(string $post_id){
        foreach (self::all()->where('post_id', '=', $post_id) as $comment){
            $comment->delete();
        }
    }
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
