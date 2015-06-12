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

// Web platform
Route::get('/', 'VariousController@index');
Route::get('/register', 'AuthController@ViewRegister');
Route::get('/management', 'AuthController@getUsers');
Route::get('/logout', 'AuthController@Logout');
Route::post('/register', 'AuthController@postRegister');
Route::get('/block/{id}', 'AuthController@doBlock');
Route::get('/unblock/{id}', 'AuthController@doUnBlock');
Route::get('/delete/{id}', 'AuthController@deleteUser');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// API
Route::get('/kloekecode/all', 'ApiKloekecode@index');

Route::post('/user/insert', 'ApiUsers@store');
Route::get('/user/all', 'ApiUsers@index');
Route::get('/user/{id}', 'ApiUSers@show');
Route::delete('/user/{id}', 'ApiUsers@destroy');