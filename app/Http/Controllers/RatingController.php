<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index(Post $post, Request $request)
    {
        $status = $request->liked;
        $rating = Rating::all()->where('user_id', Auth::id())->where('post_id', $post->id)->first();
        if ($rating) {
            if ($rating->liked == $status) {
                $rating->delete();
            }else{
                $rating->liked = $status;
                $rating->save();
            }
        }else{
            $rating = new Rating();
            $rating->user_id = Auth::id();
            $rating->post_id = $post->id;
            $rating->liked = $status;
            $rating->save();
        }
        return redirect()->back();
    }

}
