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

Route::get('/', function () {
    return view('home');
});

Route::resource('posts', 'PostsController')->middleware('auth');
Route::resource('archive', 'ArchiveController');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard')->middleware('auth');