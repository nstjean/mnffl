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

Route::get('/', 'HomeController@index')->name('home')->middleware('auth_check');

Route::resource('posts', 'PostsController');
Route::resource('archive', 'ArchiveController');
Route::resource('users', 'UsersController');
Route::get('/profile/edit', 'UsersController@editLoggedIn')->middleware('auth');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/password/change', 'ChangePasswordController@showChangePasswordForm');
Route::post('/password/update', 'ChangePasswordController@update');