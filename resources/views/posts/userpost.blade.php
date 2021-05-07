@extends('layout.layout')
@section('title','Post')

@section('content')

<div class="container-one">

    <div class="content-one">
        <h2>{{ $user->name }}</h2>
        <p>Posted {{ $posts->count() }} 
            <span>@if (($posts->count())>1) posts @else post @endif </span>
            and  recieved {{ $user->recievedLikes->count() }} <span>@if ($user->recievedLikes->count()>1) likes @else like @endif </span></p>
    <div style="width: 40%">
            {{-- if there is a post) --}}
            @if ($posts->count()) 
                @foreach ($posts as $post)
                {{-- blade component to eliminate code repetition(more like include function) --}}
               <x-post :post='$post'/>
                @endforeach

                <div style="width:5%;">
                    {{-- pagination --}}
                    {{ $posts->links() }}
                </div>
            @else
                <p>{{ $user->name }} does not have any post</p>
            @endif
        </div>

    </div>
</div>
@endsection