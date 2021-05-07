@extends('layout.layout')
@section('title', 'Posts')

@section('content')

    <div class="container-one">
        <div class="content-one">
            @auth
                <form action="{{ route('post') }}" method="post" enctype="multipart/form-data" id="form_2">
                    @csrf
                    <label for="body"></label>
                    <textarea name="body" id="" cols="60" rows="4" placeholder="Post Something"></textarea>
                    @error('body')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <input type="file" name="image" id="">
                    @error('image')
                        <p class="error">{{ $message }}</p>
                    @enderror

                    <div class="form-control">
                        <button type="submit">Post</button>
                    </div>

                </form>
            @endauth
            <div style="width: 40%">
                {{-- if there is a post) --}}
                @if ($posts->count())
                    @foreach ($posts as $post)
                        {{-- blade component to eliminate code repetition(more like include function) --}}
                        <x-post :post='$post' />
                    @endforeach

                    <div style="width:5%;">
                        {{-- pagination --}}
                        {{ $posts->links() }}
                    </div>
                @else
                    <p>There are no posts</p>
                @endif
            </div>
        </div>

    </div>







@endsection
