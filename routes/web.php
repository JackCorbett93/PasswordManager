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
Route::get('/home', 'PostsController@index')->middleware('auth');
Route::get('/', 'PostsController@index')->middleware('auth');
Route::get('/services', 'PagesController@services');
Route::get('layouts/posts', 'PostsController@index');
Route::any('/search', 'PostsController@search');
Route::any('/save', 'PostsController@exportxml');
Auth::routes();
Route::resource('posts', 'PostsController')->middleware('auth');

//Route::get('/home', 'HomeController@index')->name('home');
