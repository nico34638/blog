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
$slugPattern = '[a-z0-9\-]+';

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'PostController@index')->name('posts.index');
Route::get('/{slug}', 'PostController@show')->name('posts.show')->where('slug', $slugPattern);
Route::get('/category/{slug}', 'PostController@category')->name('posts.category')->where('slug', $slugPattern);
Route::get('/user/{id}', 'PostController@user')->name('posts.user')->where('id', '[0-9]+');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::resource('posts', 'PostController');
});
