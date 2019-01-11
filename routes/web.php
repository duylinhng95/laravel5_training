<?php /** @noinspection ALL */

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

Route::group(['middleware' => 'user.auth'], function () {
    Route::group(['prefix' => 'post'], function () {
        Route::get('/', 'PostController@index');
        Route::get('/{id}', 'PostController@show');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index');
        Route::group(['prefix' => 'post', 'namepsace' => 'User'], function () {
            Route::get('/', 'PostController@index');
            Route::get('/create', 'PostController@create');
            Route::get('/{id}', 'PostController@show');
            Route::post('/create', 'PostController@store');
            Route::get('/{id}/edit', 'PostController@edit');
            Route::delete('/{id}', 'PostController@destroy');
            Route::put('/{id}', 'PostController@update');
        });
    });
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('register', 'UserController@showRegister');
    Route::post('register', 'UserController@register');
    Route::get('login', 'UserController@showLogin');
    Route::post('login', 'UserController@login')->name('auth.login');
    Route::get('logout', 'UserController@logout');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::group(['prefix' => 'user', 'namespace' => 'Admin'], function () {
        Route::get('import', 'UserController@import');
        Route::get('block', 'UserController@block');
        Route::get('unblock', 'UserController@unblock');
    });
    Route::group(['prefix' => 'category', 'namepsace' => 'Admin'], function () {
        Route::get('/', 'CategoryController@index');
        Route::post('/', 'CategoryController@store');
        Route::get('/{id}', 'CategoryController@show');
        Route::put('/', 'CategoryController@save');
        Route::delete('/{id}', 'CategoryController@delete');
    });

    Route::group(['prefix' => 'post', 'namepsace' => 'Admin'], function () {
        Route::get('/', 'PostController@all');
        Route::get('/{id}', 'PostController@show');
    });
});
