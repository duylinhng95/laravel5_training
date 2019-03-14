<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['namespace' => 'API'], function () {
    Route::post('/check-register', 'UserController@register');
    Route::post('/check-login', 'UserController@login');
    Route::get('/load-post', 'PostController@getPost');
    Route::post('/set-interest', 'UserController@setInterest');
    Route::get('/get-interest', 'UserController@getInterest');
    Route::get('/load-interest-post', 'PostController@loadInterestPost');
    Route::get('/browse', 'PostController@browse');
    Route::post('/user/avatar/', 'UserController@updateAvatar');
    Route::get('/change-status', 'UserController@changeStatus');
});
