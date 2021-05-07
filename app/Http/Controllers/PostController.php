<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        // prevents only creation and deletion of post(post can be viewed)
        $this->middleware(['auth'])->only('store', 'destroy');
    }
    public function index()
    {
        //pagination //reduced query with (with('user','likes'))
        $posts = Post::with('user', 'likes', 'comments')->latest()->paginate(10);
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    // show a post on a page 
    public function show(Post $post)
    {
        return view('posts.showPost', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        if ($request->hasFile('image')) {    //if user wishes to upload image with the post
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/Post_images', $filename); // save filr in public directory
        } else {
            $filename = '';
        }
        $request->user()->posts()->create([
            //user_id automatically filled in(a set in the user model)
            'body' => Request('body'),
            "image_path" => $filename,
        ]);
        return back();
    }
    public function destroy($id, Request $request)
    {
        $infos = Post::where('id', $id)->get();
        foreach ($infos as $info) {
            //prevents unauthorized user hacking and deleting a post
            if ($info->user_id != auth()->user()->id) {
                return response(null, 409);
            } else
                Post::where('id', $id)->delete();
            return back();
        }
    }
}