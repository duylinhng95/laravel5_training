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
    return view('welcome');
});
Route::group(['prefix' => 'post', 'middleware' => 'user.auth'], function () {
    Route::resource('/', 'PostController');
    Route::get('/{id}/delete', 'PostController@destroy');
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('register', 'UserController@showRegister');
    Route::post('register', 'UserController@register');
    Route::get('login', 'UserController@showLogin');
    Route::post('login', 'UserController@login')->name('auth.login');
    Route::get('logout', 'UserController@logout');
});
