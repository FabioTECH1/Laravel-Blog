<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt; // imported for encryption
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{

    public function __construct()
    {
        // prevents register when logged in
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view("auth.register ");
    }

    public function store(Request $request)
    {
        // email and password validations
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required | email',
            'password' => 'required | alphaNum | confirmed | min:6 | max:15'
        ]);

        //store data to database
        User::create([
            'name' => Request('name'),
            'email' => Request('email'),
            'password' => Hash::make(Request('password')),
            // 'password' => Crypt::encrypt(Request('password')),
            'username' => Request('username'),
        ]);

        //sign in
        $checkLogin = ($request->only('email', 'password'));
        Auth::attempt($checkLogin);
        return redirect()->route('dashboard');
    }
}