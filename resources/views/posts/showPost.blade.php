@extends('layout.layout')
@section('title', 'Post')

@section('content')

    <div class="container-one">

        <div class="content-one">

            <div style="width: 40%">
                <x-post :post='$post' />
            </div>

        </div>
    </div>
@endsection
