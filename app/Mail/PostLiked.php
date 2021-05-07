<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostLiked extends Mailable
{
    use Queueable, SerializesModels;
    public $liker;
    public $post;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $liker, Post $post)
    {
        $this->liker = $liker;
        $this->post = $post;
    }

    /** 
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from("fabiotech46@gmail.com")->markdown('emails.posts.postLikes');
        return $this->markdown('emails.posts.postLikes');
    }
}