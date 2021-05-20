@extends('layout.layout')
@section('title', 'Post')

@section('content')

    <div class="container-one">

        <div class="content-one post">
            <div class="container-2">
                <x-post :post='$post' />
            </div>
        </div>
    </div>
@endsection
