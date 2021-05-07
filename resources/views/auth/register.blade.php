@extends('layout.layout')
@section('title', 'Register')

@section('content')

    <div class="container-one">
        <div class="content-one w-4">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-control">
                    <label for="name" class="sr-only">Name</label>
                    <input type="text" name="name" placeholder="Your Name" class="input-look @error('name')error @enderror"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-control">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" name="username" placeholder="Your Username" value="{{ old('username') }}">
                </div>
                @error('username')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form-control">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}">
                </div>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form-control">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" placeholder="Choose a password">
                </div>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form-control">
                    <label for="password" class="sr-only">Password Again</label>
                    <input type="password" name="password_confirmation" placeholder="Repeat your password">
                </div>
                @error('password_confirmation')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form-control">
                    <button type="submit">Register</button>
                </div>


            </form>
        </div>

    </div>







@endsection
