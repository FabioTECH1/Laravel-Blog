<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply_like extends Model
{
    use HasFactory;
    protected $table = 'reply_likes';
    protected $fillable = [
        'user_id',
        'post_id',
        'comment_replies_id'

    ];
}