<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // protected $fillabe = [
    //     'body',
    //     'user_id'
    // ]; // mass assignment protection
    protected $guarded = ['id'];

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id); // to check a user exists in the likes for the post
    }

    public function user()
    {
        return $this->belongsTo(User::class);  //linking the posts to the user that posted it 
    }

    public function likes()
    {
        return $this->hasMany(Like::class);   //linking the posts to the like
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);   //linking the posts to the comments
    }
}