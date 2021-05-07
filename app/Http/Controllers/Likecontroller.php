<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class Likecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //liking a post
    public function store(Post $post, Request $request)
    {



        if ($post->likedBy($request->user())) {  //check if post has been liked by the user
            return response(null, 409);
        }

        $post->likes()->create([
            // 'user_id' => $post->user_id,
            'user_id' => $request->user()->id,
        ]);
        // $user = auth()->user();
        // if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
        //     Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        // }
        return back();
    }

    // unliking a post
    public function destroy(User $user, Post $post, Request $request)
    {
        // dd($request->user()->id);
        Like::where('post_id', $post->id)->where('user_id', $request->user()->id)->delete();
        return back();
    }























    //     public function store($id, Request $request)
    //     {
    //         // $post_details = Post::where('id', $id)->get();

    //         // // increment of likes per click
    //         // foreach ($post_details as $like_info) {
    //         //     $likedBy = $like_info->likedBy;

    //         //     if ((auth()->user()->id) == $likedBy) {
    //         //         return back();
    //         //     } else
    //         //         Post::where('id', $id)->update([
    //         //             'likedBy' => $like_info->user_id,
    //         //         ]);
    //         //     $new_like = ($like_info->likes + 1);
    //         //     Post::where('id', $id)->update([
    //         //         'likes' => $new_like,
    //         //     ]);

    //         //     return back();
    //         // }
    //     }

}