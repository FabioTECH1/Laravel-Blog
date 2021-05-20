@extends('layout.layout')
@section('title', 'Register')

@section('content')

    <div class="container-one">
        <div class="content-one">
            <p class="form-header">Create an Account</p>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-control">
                    <label for="name" class="sr-only">Name</label>
                    <br>
                    <input class="input1 @error('name')errorinput @enderror" type="text" name="name"
                        value=" {{ old('name') }}">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-control">
                    <label for="username" class="sr-only">Username</label>
                    <br>
                    <input class="input1 @error('username')errorinput @enderror" type="text" name="username"
                        value="{{ old('username') }}">
                </div>
                @error('username')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form-control">
                    <label for="email" class="sr-only">Email</label>
                    <br>
                    <input class="input1 @error('email')errorinput @enderror" type="email" name="email"
                        value="{{ old('email') }}">
                </div>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form-control">
                    <label for="password" class="sr-only">Password</label>
                    <br>
                    <input class="input1 @error('password')errorinput @enderror" type="password" name="password">
                </div>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form-control">
                    <label for="password" class="sr-only">Confirm Password</label>
                    <br>
                    <input class="input1 @error('password')errorinput @enderror" type="password"
                        name="password_confirmation">
                </div>
                @error('password_confirmation')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form-control">
                    <br>
                    <button class="button1" type="submit">Create your Account</button>
                </div>

            </form>
            <p class="have-account">Already have an account ? <a class="link-login" href="{{ route('login') }}">Log in</a>
            </p>
        </div>

    </div>







@endsection
