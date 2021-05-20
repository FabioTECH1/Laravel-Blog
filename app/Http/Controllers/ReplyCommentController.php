<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Comment_reply;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ReplyCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post, Comment $comment, Request $request)
    {
        $comment->comment_replies()->create([
            'user_id' => $request->user()->id,
            'comment_reply' => Request('reply'),
            'replier' => auth()->user()->name,
        ]);
        // // if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
        // //     Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        // // }
        return back();
    }
    public function destroy($id, Request $request)
    {
        $infos = Comment_reply::where('id', $id)->get();
        foreach ($infos as $info) {
            //prevents unauthorized user hacking and deleting a post
            if ($info->user_id != auth()->user()->id) {
                return response(null, 409);
            } else
                Comment_reply::where('id', $id)->delete();
            return back();
        }
    }
}