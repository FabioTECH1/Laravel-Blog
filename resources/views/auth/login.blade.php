@extends('layout.layout')
@section('title', 'Login')

@section('content')

    <div class="container-one">
        <div class="content-one w-4">
            @if (session('msge-1'))
                <p class="error">{{ session('msge-1') }} </p>
            @endif
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-control">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}">
                </div>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form-control">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" placeholder="Your password">
                </div>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form-control">
                    <input type="checkbox" name="remember">
                    <label for="Remember Me" class="">Remember me</label>

                </div>
                <a href="{{ route('password.request') }}">Forgot Password ?</a>

                <div class="form-control">
                    <button type="submit">Login</button>
                </div>


            </form>

        </div>

    </div>

@endsection
