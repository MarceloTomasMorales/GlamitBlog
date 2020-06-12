<?php

use Illuminate\Support\Facades\Route;
use App\Post;

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

Route::get('/', function () {
    return view('home', ["posts"=> Post::orderBy("id", "desc")->get()]);
});

Route::post('/login', 'Auth\LoginController@login')->name('login');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::post('/newPost', 'PostController@store')->name('newPost')->middleware('permission:create post');
    Route::post('/deletePost', 'PostController@delete')->name("deletePost")->middleware('permission:delete post');
    Route::post('/LikePost', 'HomeController@LikePost')->name('LikePost')->middleware('permission:liker post');
    Route::get('/Posts', 'PostController@index')->name("Posts")->middleware('permission:show post');
    Route::get('/AdminPosts', 'PostController@getAllPost')->name("AdminPosts")->middleware('permission:show all post');
    Route::post('/saveComment', 'CommentController@store')->name('comments.store')->middleware('permission:comment');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/updatePost', 'PostController@update')->name("updatePost");
Route::get('/getPost', 'PostController@getPost')->name("getPost");

Route::get('/{any}', function ($any) {
    return redirect("/");
});
Route::post('/{any}', function ($any) {
    return redirect("/");
});