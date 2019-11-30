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



Auth::routes();

Route::get('/','PostController@index')->name('posts.index');
Route::post('follow/{user}','FollowController@store')->name('follow.store');
Route::get('/profile/{id}', 'ProfileController@index')->name('profile.show');
Route::patch('/profile/{user}', 'ProfileController@update')->name('profile.update');
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::get('/posts/create', 'PostController@create')->name('posts.create');
Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
Route::post('/posts','PostController@store')->name('posts.store');
