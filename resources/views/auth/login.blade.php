@extends('layout.layout')
@section('title', 'Login')

@section('content')

    <div class="container-one">
        <div class="content-one">


            <p class="form-header">Log into your Account</p>
            @if (session('msge-1'))
                <p class="error">{{ session('msge-1') }} </p>
            @endif
            <form action="{{ route('login') }}" method="post">
                @csrf
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
                    <input class="checkbox" type="checkbox" name="remember">
                    <label for="Remember Me" class="remember">Remember me</label>

                </div>
                <a href="{{ route('password.request') }}">Forgot Password ?</a>

                <div class="form-control">
                    <button class="button1" type="submit">Log In</button>
                </div>


            </form>
        </div>
    </div>

    </div>

@endsection
