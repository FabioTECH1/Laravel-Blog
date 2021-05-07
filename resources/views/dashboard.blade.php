@extends('layout.layout')
@section('title', 'Dashboard')

@section('content')

    <div class="container-one">
        <div class="content-one">

            @if (auth()->user()->profile_pic)
                <img style="width: 100px; height:100px;"
                    src="{{ asset('uploads/profile_pics/' . auth()->user()->profile_pic) }}" alt="Profile Picture">
            @else
                <img style="width: 100px; height:100px;" src="{{ asset('uploads/profile_pics/profile_pic.png') }}"
                    alt="Profile Picture">
            @endif
            <form action="{{ route('profilePic.change') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="image" id="">
                <button type="submit">Upload</button>

                <p>{{ session('message') }}</p>

            </form>

        </div>
    </div>
@endsection
