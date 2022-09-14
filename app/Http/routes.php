<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PostController@index' );
Route::get('/home', 'PostController@index' );
Route::get('competition/{kategori}', 'PostController@category');
Route::get('search', 'PostController@search');
Route::get('deadline', 'PostController@orderByDate');

Route::get('leaderboard', 'ProfileController@rank');

Route::get('api/post', 'ApiController@post');
Route::get('api/{kategori}', 'ApiController@category');

Route::auth();

Route::group(['middleware' => 'auth'], function () {
	Route::get('create', 'PostController@create');
	Route::post('post', 'PostController@store');
	Route::get('edit/{id}', 'PostController@edit');
	Route::put('update/{id}', 'PostController@update');
	Route::get('delete/{id}', 'PostController@destroy');
	Route::get('user/posts', 'PostController@post');
	Route::get('user/bookmarks', 'BookmarkController@index');
	Route::put('post/bookmark/{id}', 'BookmarkController@store');
	Route::get('bookmark/delete/{id}', 'BookmarkController@destroy');
	Route::get('user/profile/{username}', 'ProfileController@index');
	Route::get('add-students', 'ProfileController@addAccount');
	Route::post('upload-user', 'ProfileController@uploadFile');
	Route::post('update-profile/{username}', 'ProfileController@updateProfile');
	Route::get('UIItheChampion/download', 'BookmarkController@download');
});