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

Route::get('/', 'PagesController@index');

Route::get('/PasswordManager', 'PagesController@pass');
Route::get('/services', 'PagesController@services');
Route::get('layouts/posts', 'PostsController@index');
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
