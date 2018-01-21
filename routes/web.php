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

Route::get("", function()
{
    return "Hi there, please go <a href='/users'>here!</a>";
});
Route::get('/users', 'UserController@index')->name("users");
Route::get('/users/new', 'UserController@new')->name("users.new");
Route::post('/users/new', 'UserController@add');
Route::post('/users/{id}', 'UserController@update')->name("users.profile");
Route::get('/users/{id}', 'UserController@show');