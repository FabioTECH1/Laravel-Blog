<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@index')
    ->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@store');

Route::get('/forgot-password', 'App\Http\Controllers\Auth\ResetPasswordController@index')
    ->name('password.request');
Route::post('/forgot-password', 'App\Http\Controllers\Auth\ResetPasswordController@sendResetLink')
    ->name('password.email');

Route::get('/reset-password/{token}', 'App\Http\Controllers\Auth\FinalResetPasswordController@index')
    ->name('password.reset');
Route::post('/reset-password', 'App\Http\Controllers\Auth\FinalResetPasswordController@store')
    ->name('password.update');

Route::get('/login', 'App\Http\Controllers\Auth\LoginController@index')
    ->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@checkLogin');

Route::post('/logout', 'App\Http\Controllers\Auth\LogoutController@logout')
    ->name('logout');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')
    ->name('dashboard');
Route::post('/dashboard', 'App\Http\Controllers\DashboardController@store')
    ->name('profilePic.change');

Route::get('/posts', 'App\Http\Controllers\PostController@index')
    ->name('post');
Route::post('/posts', 'App\Http\Controllers\PostController@store');

Route::post('/posts/{post}/like', 'App\Http\Controllers\LikeController@store')
    ->name('like');
Route::delete('/posts/{post}/unlike', 'App\Http\Controllers\LikeController@destroy')
    ->name('unlike');

Route::post('/posts/{post}/comment', 'App\Http\Controllers\CommentController@store')
    ->name('comment');

Route::post('/comments/{comment}/like', 'App\Http\Controllers\CommentLikeController@store')
    ->name('comment-like');
Route::delete('/comments/{comment}/unlike', 'App\Http\Controllers\CommentLikeController@destroy')
    ->name('comment-unlike');


Route::delete('/posts/{id}/delete', 'App\Http\Controllers\PostController@destroy')
    ->name('deletepost');

Route::get('/user/{user:username}/posts', 'App\Http\Controllers\UserPostController@index')
    ->name('userpost');

Route::get('/user/{post}', 'App\Http\Controllers\PostController@show')
    ->name('showpost');


Route::get('/', function () {
    return view('home');
})->name('home');