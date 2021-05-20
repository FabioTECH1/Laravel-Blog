 @props(['post' => $post])

 <br>

 <div class="pic-name">
     <div class="prof-img">
         {{-- Poster profile picture --}}
         @if ($post->user->profile_pic)
             <img class='profile-img' src="{{ asset('uploads/profile_pics/' . $post->user->profile_pic) }}"
                 alt="Profile Picture">
         @else
             <img class='profile-img' src="{{ asset('uploads/profile_pics/profile_pic.png') }}" alt="Profile Picture">
         @endif
     </div>
     {{-- poster Name and time of post --}}
     <div class="postername-control">
         <a class="poster-name" href="{{ route('userpost', $post->user) }}">{{ $post->user->name }}</a>
     </div>
 </div>

 {{-- post posted --}}
 <div class="body-container">
     <a class="body-link" href="{{ route('showpost', $post->id) }}">
         <p class="body-p">{{ $post->body }}</p>
     </a>
     {{-- See carbon documentation for more date format  options --}}
     <p class="time-posted">{{ $post->created_at->diffForhumans() }}</p>
 </div>

 {{-- Posted Image --}}
 <div class="img-container">
     @if ($post->image_path)
         <img class="posted-img" src="{{ asset('uploads/Post_images/' . $post->image_path) }}"
             alt="{{ $post->image_path }} " />
     @endif
     <p class="like-comment">
         {{-- No of Likes --}}
         @if ($post->likes->count() > 0)
             <span>
                 {{ $post->likes->count() }}
                 @if ($post->likes->count() > 1)
                     likes
                 @else
                     like
                 @endif
             </span>
         @endif
         {{-- No of Comments --}}
         @if ($post->comments->count() > 0)
             <span style="padding-left: 18px">
                 {{ $post->comments->count() }}
                 @if ($post->comments->count() > 1)
                     comments
                 @else
                     comment
                 @endif
             </span>
         @endif
     </p>
     @auth
         <div class="del-lik-unli">
             {{-- Like and Unlike Posts --}}
             {{-- check if post has not been liked by the user --}}
             @if (!$post->likedBy(auth()->user()))
                 <form action="{{ route('like', $post->id) }}" class="like_post" method="post"
                     id="like{{ $post->id }}">
                     @csrf
                     <button type="submit" class="bttn lud like">Like <span class="heart"></span></button>
                 </form>
             @else
                 <form action="{{ route('unlike', $post->id) }}" method="post" id="unlike{{ $post->id }}">
                     @csrf
                     {{-- method spoofing ...delete method was spoofed --}}
                     @method(' delete')
                     <button type="submit" class="bttn lud unlike">Like <span class="heart-x"></button>
                 </form>
             @endif
         </div>
         <div class="del-lik-unli">
             <div class="comment-central">
                 <button class="bttn lud com">Comment</button>
             </div>
             <div class="ico"> <img class="ico" src="{{ asset('uploads/icons/comment.svg') }}"></div>
         </div>
         <div class="del-lik-unli">
             {{-- Deleteing Posts --}}
             @if ($post->user_id == auth()->user()->id)
                 <form action="{{ route('deletepost', $post->id) }}" method="post">
                     @csrf
                     {{-- method spoofing ...delete method was spoofed --}}
                     @method('delete')
                     <button type="submit" class="bttn lud del">Delete<span> <img class="ico"
                                 src="{{ asset('uploads/icons/bin.svg') }}"> </span>
                     </button>
                 </form>
             @endif
         </div>
     @endauth
 </div>


 <div class="comments-reply">
     {{-- Posting Comments --}}
     @auth
         <form action="{{ route('comment', $post->id) }}" method="post">
             @csrf
             <textarea class='post-body comment' name="comment" placeholder="        Write a comment"></textarea>
             <button style="display:;" type="submit">Post</button>
         </form>
     @endauth

     {{-- Posted Comments --}}
     @foreach ($post->comments as $comment)
         <div class="comments-adjust">
             <a href="{{ route('userpost', $post->user) }}" style="color: black; text-decoration:none;"
                 class="commenter">{{ $comment->commenter }}</a>

             <p class="comment">{{ $comment->comment }}</p>
             {{-- See carbon documentation for more date format  options --}}
             <p class="time-posted">{{ $comment->created_at->diffForhumans() }}</p>

             {{-- No of Comment Likes --}}
             @if ($comment->comment_likes->count() > 0)
                 <p class="like-comment">

                     {{ $comment->comment_likes->count() }}
                     <span>
                         @if ($comment->comment_likes->count() > 1)
                             likes
                         @else
                             like
                         @endif
                     </span>
                 </p>
             @endif

             {{-- Liking and Unliking comments --}}
             @auth
                 @if (!$comment->CommentlikedBy(auth()->user()))
                     <div class="like-unlike-reply">
                         <form action="{{ route('comment-like', $comment->id) }}" method="post"
                             id="com-like{{ $comment->id }}">
                             @csrf
                             <button type="submit" class="bttn lud like lur">Like</button>
                         </form>
                     </div>
                 @else
                     <div class="like-unlike-reply">
                         <form action="{{ route('comment-unlike', $comment->id) }}" method="post"
                             id="com-unlike{{ $comment->id }}">
                             @csrf
                             @method('delete')
                             <button type="submit" class="bttn lud unlike lur">Like</button>
                         </form>
                     </div>
                 @endif
             @endauth
             @auth
                 <div class="like-unlike-reply">
                     {{-- // Get a Reply for a comment --}}
                     <a href="javascript:{}" class="bttn lud lur"
                         onclick='document.getElementById("reply{{ $comment->id }}").style.display="inline-block" ;'>Reply</a>
                 </div>

                 {{-- Deleteing comments --}}
                 @if ($comment->user_id == auth()->user()->id)
                     <div class="like-unlike-reply">
                         <form action="{{ route('delete.comment', $comment->id) }}" method="post">
                             @csrf
                             {{-- method spoofing ...delete method was spoofed --}}
                             @method('delete')
                             <button type="submit" class="bttn lud lur">Delete</button>
                         </form>
                     </div>

                 @endif
             @endauth
             <div class="reply-arrange">
                 @auth
                     <form action="{{ route('reply-comment', $comment->id) }}" method="post"
                         id="reply{{ $comment->id }}" style="display: none">
                         @csrf
                         <textarea name="reply" cols="50" rows="1"></textarea>
                         <button type="submit">Reply</button>
                     </form>
                 @endauth


                 @foreach ($comment->comment_replies as $reply)
                     <br>
                     <a href="#" class="replier">{{ $reply->replier }}</a>
                     <p class="reply">{{ $reply->comment_reply }}
                         {{-- See carbon documentation for more date format  options --}}
                         <span
                             style="padding-left: 4px; color:gray; font-size:70% ">{{ $reply->created_at->diffForhumans() }}</span>
                     </p>
                     @auth
                         {{-- @if (!$reply->ReplylikedBy(auth()->user())) --}}
                         <div class="like-unlike-reply">
                             <form action="{{ route('reply.like', $reply->id) }}" method="post">
                                 @csrf
                                 <button type="submit" class="bttn lud like lur">Like</button>
                             </form>
                         </div>
                         {{-- @else --}}
                         <div class="like-unlike-reply">
                             <form action="{{ route('reply.unlike', $reply->id) }}" method="post">
                                 @csrf
                                 @method('delete')
                                 <button type="submit" class="bttn lud unlike lur">Like</button>
                             </form>
                         </div>
                         {{-- @endif --}}
                         <div class="like-unlike-reply">
                             {{-- // Get a Reply for a comment --}}
                             <a href="javascript:{}" class="bttn lud lur"
                                 onclick='document.getElementById("reply{{ $comment->id }}").style.display="inline-block" ;'>Reply</a>
                         </div>
                         {{-- Deleteing replies --}}
                         @if ($reply->user_id == auth()->user()->id)
                             <div class="like-unlike-reply">
                                 <form action="{{ route('delete.reply', $reply->id) }}" method="post">
                                     @csrf
                                     @method('delete')
                                     <button type="submit" class="bttn lud lur">Delete</button>
                                 </form>
                             </div>

                         @endif
                     @endauth
                 @endforeach
             </div>
         </div>
     @endforeach
 </div>
 <br>
