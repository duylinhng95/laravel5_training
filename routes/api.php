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
    Route::group(['prefix' => 'browse'], function () {
        Route::get('/', 'PostController@browse');
        Route::get('/get-tags', 'PostTagController@getTags');
        Route::get('/autocomplete', 'PostController@autocompleteKey');
    });
    Route::post('/user/avatar/', 'UserController@updateAvatar');
    Route::get('/change-status', 'UserController@changeStatus');
    Route::get('/get-post-day', 'PostController@getPostByDay');
    Route::get('/get-register-day', 'UserController@getRegisterByDay');
});
