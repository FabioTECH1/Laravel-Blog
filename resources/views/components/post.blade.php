 @props(['post' => $post])

 <br>

 {{-- Poster profile picture --}}
 @if ($post->user->profile_pic)
     <img style="width: 40px; height:40px;" src="{{ asset('uploads/profile_pics/' . $post->user->profile_pic) }}"
         alt="Profile Picture">
 @else
     <img style="width: 40px; height:40px;" src="{{ asset('uploads/profile_pics/profile_pic.png') }}"
         alt="Profile Picture">
 @endif

 {{-- poster Name and time of post --}}
 <a href="{{ route('userpost', $post->user) }}"
     style="color: black; text-decoration:none; font-weight:bolder;">{{ $post->user->name }}
 </a>
 {{-- See carbon documentation for more date format  options --}}
 <span style="padding-left: 4px; color:gray ">{{ $post->created_at->diffForhumans() }}</span>

 {{-- post posted --}}
 <a href="{{ route('showpost', $post->id) }}" style="color: black; text-decoration:none;">
     <p>{{ $post->body }}</p>
 </a>
 {{-- Posted Image --}}
 @if ($post->image_path)
     <img style="width: 300px; height:300px;" src="{{ asset('uploads/Post_images/' . $post->image_path) }}"
         alt="{{ $post->image_path }} " />
     <br>
 @endif


 {{-- No of Likes --}}
 @if ($post->likes->count() > 0)
     {{ $post->likes->count() }}
     <span>
         @if ($post->likes->count() > 1)
             likes
         @else
             like
         @endif
     </span>
 @endif

 {{-- No of Comments --}}
 @if ($post->comments->count() > 0)
     {{ $post->comments->count() }}
     <span>
         @if ($post->comments->count() > 1)
             comments
         @else
             comment
         @endif
     </span>
 @endif
 <br>


 @auth
     {{-- Like and Unlike Posts --}}
     {{-- check if post has not been liked by the user --}}
     @if (!$post->likedBy(auth()->user()))
         <form action="{{ route('like', $post->id) }}" method="post" id="like{{ $post->id }}">
             @csrf
             <a href="javascript:{}" onclick="document.getElementById('like{{ $post->id }}').submit();">Like</a>
             {{-- <button type="submit">Like</button> --}}
         </form>
     @else
         <form action="{{ route('unlike', $post->id) }}" method="post" id="unlike{{ $post->id }}">
             @csrf
             {{-- method spoofing ...delete method was spoofed --}}
             @method('delete')
             <a href="javascript:{}" onclick="document.getElementById('unlike{{ $post->id }}').submit();">Unlike</a>
             {{-- <button type="submit">Unlike</button> --}}
         </form>
     @endif

     {{-- Deleteing Posts --}}
     @if ($post->user_id == auth()->user()->id)

         <form action="{{ route('deletepost', $post->id) }}" method="post" id="form_3">
             @csrf
             {{-- method spoofing ...delete method was spoofed --}}
             @method('delete')
             <a href="javascript:{}" onclick="document.getElementById('form_3').submit();">Delete</a>

             {{-- <button type="submit">Delete</button> --}}
         </form>
     @endif
 @endauth

 {{-- Posting Comments --}}
 @auth
     <form action="{{ route('comment', $post->id) }}" method="post">
         @csrf
         <textarea name="comment" id="" cols="50" rows="2" placeholder="Write a comment....."></textarea>
         <button type="submit">Post</button>
     </form>
 @endauth
 <br>



 {{-- Posted Comments --}}
 @foreach ($post->comments as $comment)
     <br>
     <a href="#" style="color: black; text-decoration:none;">{{ $comment->commenter }}</a>
     <p>{{ $comment->comment }}
         {{-- See carbon documentation for more date format  options --}}
         <span
             style="padding-left: 4px; color:gray; font-size:70% ">{{ $comment->created_at->diffForhumans() }}</span>
     </p>


     {{-- No of Comment Likes --}}
     @if ($comment->comment_likes->count() > 0)
         {{ $comment->comment_likes->count() }}
         <span>
             @if ($comment->comment_likes->count() > 1)
                 likes
             @else
                 like
             @endif
         </span>
     @endif


     {{-- Liking and Unliking Posts --}}
     @auth
         @if (!$comment->CommentlikedBy(auth()->user()))
             <form action="{{ route('comment-like', $comment->id) }}" method="post" id="com-like{{ $comment->id }}">
                 @csrf
                 <a href="javascript:{}"
                     onclick="document.getElementById('com-like{{ $comment->id }}').submit();">Like</a>
                 {{-- <button type="submit">Like</button> --}}
             </form>
         @else
             <form action="{{ route('comment-unlike', $comment->id) }}" method="post"
                 id="com-unlike{{ $comment->id }}">
                 @csrf
                 @method('delete')
                 <a href="javascript:{}"
                     onclick="document.getElementById('com-unlike{{ $comment->id }}').submit();">Unlike</a>
                 {{-- <button type="submit">UnLike</button> --}}
             </form>
         @endif

         {{-- // Get a Reply for a comment --}}
         <a href="javascript:{}"
             onclick='document.getElementById("{{ $comment->id }}").style.display="inline-block" ;'>Reply</a><br><br>

         <form action="" method="post" id="{{ $comment->id }}" style="display: none">
             @csrf
             <textarea name="reply" id="" cols="50" rows="1"></textarea>
             <button type="submit">Reply</button>
         </form><br>
     @endauth
 @endforeach
 <br>
