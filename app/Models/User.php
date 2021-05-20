<?php

namespace App\Models;


use Illuminate\Support\Facades\Notification;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);  //one to many DB table relationship
    }

    public function recievedLikes() // number of likes recieved by a user 
    {
        return $this->hasManyThrough(Like::class, Post::class);
    }

    // public function sendPasswordResetNotification($token)
    // {
    //     $url = 'http://127.0.0.1:8000/reset-password?token=' . $token;

    //     $this->notify(new ResetPasswordNotification($token));
    // }
}