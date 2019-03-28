<?php

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

Route::group([

], function (){
    Route::get('/admin', 'Admin\DashboardController@index');
    Route::resource('admin/categories', 'Admin\CategoriesController');
    Route::resource('admin/tags', 'Admin\TagsController');
    Route::resource('admin/users', 'Admin\UsersController');
    Route::resource('admin/posts', 'Admin\PostsController');
    Route::resource('admin/subscribers', 'Admin\SubscribersController');
    Route::get('admin/comments', 'Admin\CommentsController@index');
    Route::delete('admin/comments/{id}/destroy', 'Admin\CommentsController@destroy')->name('comments.destroy');
    Route::get('admin/comments/toggle/{id}', 'Admin\CommentsController@toggle');
    Route::get('admin/users/toggle/{id}', 'Admin\UsersController@toggle');
});

Route::get('/', 'HomeController@index');
Route::get('/post/{slug}', 'HomeController@show')->name('post.show');
Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', 'HomeController@category')->name('category.show');
Route::get('/register', 'AuthController@registerForm')->middleware('guest');
Route::post('/register', 'AuthController@register')->middleware('guest');
Route::get('/login', 'AuthController@loginForm')->middleware('guest');
Route::post('/login', 'AuthController@login')->name('login')->middleware('guest');
Route::get('/logout', 'AuthController@logout')->middleware('auth');
Route::get('/about', 'PageController@about');
Route::get('/contact', 'PageController@contact');
Route::get('/profile', 'ProfileController@profile')->middleware('auth');
Route::post('/profile', 'ProfileController@update')->middleware('auth');
Route::post('/comment', 'CommentsController@store')->middleware('auth');
Route::post('/subscribe', 'SubscribeController@subscribe');
Route::get('/verify/{token}', 'SubscribeController@verify');




