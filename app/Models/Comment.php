<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
        'commenter',
    ];

    public function CommentlikedBy(User $user)
    {
        return $this->comment_likes->contains('user_id', $user->id); // to check a user exists in the likes for the post
    }
    public function comments()
    {
        return $this->belongsTo(Post::class);  //linking the comments to the post 
    }
    public function comment_likes()
    {
        return $this->hasMany(Comment_like::class);   //linking the posts to the like
    }
}