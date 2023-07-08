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

// 2.6	ログイン中のみ閲覧可能なページの設定のために記述
// ここがわからない、今はまだ無理なところ？
// Route::get('/', function () {
//     return view('/index');
// });
// Route::get('/home', 'HomeController@index')

// Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');
Route::post('/top','PostsController@create');

Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@search');

Route::get('/result','UsersController@result');

Route::get('/followed/{userId}','UsersController@followed');

Route::get('/unFollowed/{userId}','UsersController@unFollowed');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');