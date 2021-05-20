<?php

namespace App\Http\Controllers;

use App\Models\Comment_reply;
use App\Models\Post;
use App\Models\Reply_like;
use Illuminate\Http\Request;

class ReplyLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //liking a post
    public function store($id, Post $post, Comment_reply $reply, Request $request)
    {
        dd($reply);
        $reply->reply_likes()->create([
            'user_id' => $request->user()->id,
        ]);
        // if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
        //     Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        // }
        return back();
    }
    // unliking a comment
    public function destroy(Comment_reply $reply, Request $request)
    {
        Reply_like::where('comment_replies_id', $reply->id)->where('user_id', $request->user()->id)->delete();
        return back();
    }
}