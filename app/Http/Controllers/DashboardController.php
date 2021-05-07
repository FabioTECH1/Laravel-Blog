<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\PostLiked;
use App\Models\User;
use Illuminate\Support\Facades\DB;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        // prevents dashboard view without logging in
        $this->middleware(['auth']);
    }
    public function index()
    {
        // dd(auth()->user()->posts);
        return view('dashboard');
    }
    public function store(Request $request, User $user)
    {
        $request->validate([
            'image' => 'required | mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
        ]);
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('uploads/profile_pics', $filename);

        User::where('id', auth()->user()->id)->update([
            'profile_pic' => $filename
        ]);
        return back()->with('message', 'Profile Picture Updated');
    }
}