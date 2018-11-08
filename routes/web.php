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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/permission', 'PermissionController');
Route::resource('/role', 'RoleController');
Route::resource('/user', 'UserController');
Route::resource('/post', 'PostController');
Route::resource('/category', 'CategoryController');
Route::post("/post/comment/{post}", 'CommentController@store')->name('comment.store');
Route::put("/post/comment/{id}", 'CommentController@update')->name('comment.update');

//Route::get('/comment/{comment}','CommentController@show');
Route::get('/profile/{username}','ProfileController@show')->name('profile.show');
Route::post('/profile/avatar', 'ProfileController@avatar')->name('profile.avatar');
Route::post('/likes/post/{postId}','PostLikeController@store')->name('like.post');
Route::post('/unlikes/post/{postId}','PostLikeController@unlikePost')->name('unlike.post');
Route::get('/following/{id}','FollowController@store')->name('follow.store');
Route::get('/unfollowing/{id}','FollowController@unfollowing')->name('unfollow.store');
Route::get('/findUser', 'ProfileController@index')->name('profile.index');
Route::get('/search/user', 'UserController@search')->name('search.user');
Route::get('/profile/edit/{id}', 'ProfileController@edit')->name('profile.edit');
Route::put('profile/update/{id}','ProfileController@update')->name('profile.update');
Route::get('/profile/chanage/password', 'ProfileController@ChangePasswordView')->name('profile.change');
Route::put('/profile/chanage/password/{id}', 'ProfileController@ChangePassword')->name('profile.change.put');
