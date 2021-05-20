@extends('layout.layout')
@section('title', 'Posts')

@section('content')

    <div class="container-one">
        <div class="content-one post">
            <div class="container-2">
                @auth
                    <form action="{{ route('post') }}" method="post" enctype="multipart/form-data" id="form_2">
                        @csrf
                        <label for="body"></label>
                        <textarea class='post-body' name="body" placeholder="            Make a New Post"></textarea>
                        @error('body')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        <input style="display:none;" type="file" name="image" id="">
                        @error('image')
                            <p class="error">{{ $message }}</p>
                        @enderror

                        <div class="form-control">
                            <button type="submit" style="display:none;">Post</button>
                        </div>

                    </form>
                @endauth
                <div>
                    {{-- if there is a post) --}}
                    @if ($posts->count())
                        @foreach ($posts as $post)
                            {{-- blade component to eliminate code repetition(more like include function) --}}
                            <x-post :post='$post' />
                        @endforeach
                        {{-- <script>
                        const likeForms = document.querySelectorAll(".like_post")
                        likeForms.forEach(likeForm => {
                            likeForm.addEventListener('submit', likePost)
                        })

                        function likePost(e) {
                            e.preventDefault()

                            const id = e.target.id.match(/[^Like].*/i)[0]
                            const xhr = new XMLHttpRequest()
                            xhr.onload = function() {
                                console.log(xhr.responseText)
                            }
                            const body = {
                                post_id: id
                            }
                            xhr.open('POST', `http://127.0.0.1:8000/posts/${id}/like`)
                            xhr.setRequestHeader('Content-type', 'application/json')
                            xhr.send(JSON.stringify(body))
                            console.log(id)
                        }

                    </script> --}}

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
    </div>




@endsection
