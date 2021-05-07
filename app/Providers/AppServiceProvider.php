<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Like;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Post $post)
    {
        // $checkLike = Like::where('post_id', '=', $post->id)->where('user_id', '=', $post->user_id)->first();
        // view()->share('checkLike', $checkLike);
    }
}