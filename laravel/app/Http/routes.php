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
Route::post('/register', 'AuthController@postRegister');
Route::post('/login', 'AuthController@verifyLogin');

// API
Route::post('/user/insert', 'ApiUsers@store');
Route::get('/user/all', 'ApiUsers@index');
Route::get('/user/{id}', 'ApiUSers@show');
Route::delete('/user/{id}', 'ApiUsers@destroy');