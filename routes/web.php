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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', 'PostsController@index')->name('home');

Route::resource('posts',            'PostsController');
Route::resource('posts.comments',   'CommentsController');

// Route::resource('tags',             'TagsController');
// Route::resource('posts.tags',       'PostsTagsController');
Route::get('/posts/tags/{tag}', 'PostsTagsController@index');
