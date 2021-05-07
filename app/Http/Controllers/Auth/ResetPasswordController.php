<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        // prevents resetpassword when logged in
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('auth.forgotpass');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
        ]);
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}