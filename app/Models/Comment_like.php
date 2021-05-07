<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_like extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'comment_likes';
    protected $fillable = [
        'user_id',
        'post_id'
    ];

    public function comment_likes()
    {
        return $this->belongsTo(Comment::class);  //linking the likes to the post 
    }
}