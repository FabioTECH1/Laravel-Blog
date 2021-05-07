@extends('layout.layout')
@section('title', 'Login')

@section('content')

    <div class="container-one">
        <div class="content-one w-4">
            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <div class="form-control">
                    <label for="password" class="sr-only">Email</label>
                    <input type="email" name="email" id="" placeholder="Your Email">

                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-control">
                    <button type="submit">Reset</button>
                </div>
            </form>

        </div>

    </div>

@endsection
