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

Route::group(['middleware' => 'user.auth'], function () {
    Route::group(['prefix' => 'post'], function () {
        Route::get('/{id}', 'PostController@show')->name('post.show');
        Route::post('/comment/{id}', 'PostController@comment')->name('post.comment');
        Route::get('/vote/{id}', 'PostController@vote')->name('post.vote');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@listUser')->name('user.list');
        Route::get('/info', 'UserController@index')->name('user.index');
        Route::get('/follow/{id}', 'UserController@follow')->name('user.follow');
        Route::get('/unfollow/{id}', 'UserController@unfollow')->name('user.unfollow');

        Route::group(['prefix' => 'post', 'namespace' => 'User'], function () {
            Route::get('/', 'PostController@index')->name('user.post.index');
            Route::get('/create', 'PostController@create')->name('user.post.create')->middleware('user.block');
            Route::get('/{id}', 'PostController@show')->name('user.post.show');
            Route::post('/create', 'PostController@store')->name('user.post.store')->middleware('user.block');
            Route::get('/{id}/edit', 'PostController@edit')->name('user.post.edit');
            Route::delete('/{id}', 'PostController@destroy')->name('user.post.delete');
            Route::put('/{id}', 'PostController@update')->name('user.post.update');
        });
    });
});

Route::group(['prefix' => '/'], function () {
    Route::get('register', 'UserController@showRegister')->name('auth.register');
    Route::post('register', 'UserController@register')->name('auth.register');
    Route::get('login', 'UserController@showLogin')->name('auth.login');
    Route::post('login', 'UserController@login')->name('auth.login');
    Route::get('logout', 'UserController@logout')->name('auth.logout');
    Route::get('/', 'PostController@index')->name('post.index');
    Route::group(['prefix' => 'post'], function () {
        Route::get('/{id}', 'PostController@show')->name('post.show');
    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::group(['namespace' => 'Admin'], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('import', 'UserController@import');
            Route::get('block', 'UserController@block');
            Route::get('unblock', 'UserController@unblock');
        });
        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'CategoryController@index');
            Route::post('/', 'CategoryController@store');
            Route::get('/{id}', 'CategoryController@show');
            Route::put('/', 'CategoryController@save');
            Route::delete('/{id}', 'CategoryController@delete');
        });

        Route::group(['prefix' => 'post'], function () {
            Route::get('/', 'PostController@all')->name('admin.post');
            Route::get('/{id}', 'PostController@show')->name('admin.post.show');
            Route::delete('/{id}', 'PostController@delete')->name('admin.post.delete');
            Route::get('/restore/{id}', 'PostController@restore')->name('admin.post.restore');
        });
    });
    Route::get('/password', 'AdminController@showPassword')->name('admin.password');
    Route::post('/password', 'AdminController@storePassword')->name('admin.password.store');
});
