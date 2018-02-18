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

Route::match(['get', 'post'], '/', 'UserController@login');
Route::get('/users', 'UserController@index')->name("users");
Route::get('/logout', 'UserController@logout');
Route::match(['get', 'post'], '/users/new', 'UserController@new')->name("users.new");
Route::match(['get', 'post'], '/users/{id}', 'UserController@update')->name("users.profile");
