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
    return redirect('/post');
});
Route::group(['prefix' => 'post', 'middleware' => 'user.auth'], function () {
    Route::resource('/', 'PostController');
    Route::get('/{id}/edit', 'PostController@edit');
    Route::get('/{id}/delete', 'PostController@destroy');
});

Route::group(['prefix' => 'user', 'middleware' => 'user.auth'], function () {
    Route::get('/', 'UserController@index');
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('register', 'UserController@showRegister');
    Route::post('register', 'UserController@register');
    Route::get('login', 'UserController@showLogin');
    Route::post('login', 'UserController@login')->name('auth.login');
    Route::get('logout', 'UserController@logout');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function () {
    Route::get('/', 'AdminController@index');
    Route::group(['prefix' => 'user'], function () {
        Route::get('import', 'AdminController@importUser');
        Route::get('block', 'AdminController@blockUser');
        Route::get('unblock', 'AdminController@unblockUser');
    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index');
        Route::post('/', 'CategoryController@store');
        Route::get('/{id}', 'CategoryController@show');
        Route::put('/', 'CategoryController@save');
        Route::delete('/{id}', 'CategoryController@delete');
    });

    Route::group(['prefix' => 'post'], function () {
        Route::get('/', 'AdminController@listPost');
    });
});
