<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function __construct()
    {
        // prevents register when logged in
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('auth.login');
    }

    public function checkLogin(Request $request)
    {
        // set the remember me cookie if the user check the box
        // email and password validations
        $request->validate([
            'email' => 'required | email',
            'password' => 'required | min:6 | max:15'
        ]);
        // dd($remember);
        //Check credentials to log in user
        $checkLogin = ($request->only('email', 'password'));

        //remember already logged in user
        $remember = Request('remember');
        if (Auth::attempt($checkLogin, $remember)) {
            return redirect()->route('post');
        } else
            // starts a flash session and returns a message for unregisstered users
            return back()->with('msge-1', 'Invalid login details');
    }
}