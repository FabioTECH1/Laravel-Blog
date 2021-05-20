<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_reply extends Model
{
    use HasFactory;
    protected $table = 'comment_replies';
    protected $guarded = [
        'id',
    ];

    public function ReplylikedBy(User $user)
    {
        return $this->reply_likes->contains('user_id', $user->id); // to check a user exists in the likes for the post
    }
    public function reply_likes()
    {
        return $this->hasMany(reply_like::class, "comment_reply_id", "id");   //linking the posts to the like
    }
}