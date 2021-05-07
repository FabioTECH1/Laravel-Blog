<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Like;




use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user)

    {

        $like = Like::where('user_id', $user->id)->count();
        $userpost = Post::where('user_id', $user->id)->with('user', 'likes')->latest()->paginate(10);

        return view('posts.userpost', [
            'posts' => $userpost,
            'user' => $user,
            'like' => $like,
        ]);
    }
}