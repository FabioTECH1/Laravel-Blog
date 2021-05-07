<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title')</title>


    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <style>
        .error {
            color: red;
        }

    </style>
</head>

<body>
    {{-- <div class="nav-control"> --}}
    <nav class="nav-bar">
        <ul class="list-control">
            <li class="nav-list">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-list">
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-list">
                <a href="{{ route('post') }}" class="nav-link">Posts</a>
            </li>
        </ul>
        <ul class="list-control">
            {{-- Check if logged in --}}
            @if (auth()->user())
                <li class="nav-list">
                    <a href="{{ route('register') }}" class="nav-link">{{ auth()->user()->name }}</a>
                </li>
                <li class="nav-list">
                    <form action="{{ route('logout') }}" method="post" id="form_1">
                        @csrf
                        <a href="javascript:{}" onclick="document.getElementById('form_1').submit();">Logout</a>
                        {{-- <button type="submit" class="nav-link bttn">Logout</button> --}}
                    </form>
                </li>
            @else
                <li class="nav-list">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>
                <li class="nav-list">
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </li>
            @endif
        </ul>
    </nav>
    {{-- </div> --}}
    @yield('content')
</body>

</html>
