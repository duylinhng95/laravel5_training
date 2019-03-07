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
        Route::get('/{slug}', 'PostController@show')->name('post.show');
        Route::post('/comment/{slug}', 'PostController@comment')->name('post.comment');
        Route::get('/vote/{slug}', 'PostController@vote')->name('post.vote');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@listUser')->name('user.list');
        Route::get('/info', 'UserController@index')->name('user.index');
        Route::get('/follow/{id}', 'UserController@follow')->name('user.follow');

        Route::group(['prefix' => 'post', 'namespace' => 'User'], function () {
            Route::get('/', 'PostController@index')->name('user.post.index');
            Route::get('/create', 'PostController@create')->name('user.post.create')->middleware('user.block');
            Route::get('/{slug}', 'PostController@show')->name('user.post.show');
            Route::post('/create', 'PostController@store')->name('user.post.store')->middleware('user.block');
            Route::get('/{slug}/edit', 'PostController@edit')->name('user.post.edit');
            Route::delete('/{slug}', 'PostController@destroy')->name('user.post.delete');
            Route::put('/{slug}', 'PostController@update')->name('user.post.update');
        });
    });
});

Route::group(['prefix' => '/'], function () {
    Route::post('register', 'UserController@register')->name('auth.register');
    Route::post('validateRegister', 'UserController@checkInputRegister')->name('validate.register');
    Route::post('validateLogin', 'UserController@checkInputLogin')->name('validate.');
    Route::post('login', 'UserController@login')->name('auth.login');
    Route::get('logout', 'UserController@logout')->name('auth.logout');
    Route::get('/', 'PostController@index')->name('post.index');
    Route::group(['prefix' => 'post'], function () {
        Route::get('/{slug}', 'PostController@show')->name('post.show');
    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::get('/{id}', 'CategoryController@show')->name('category.show');
    });

    Route::get('/admin/login', 'AdminController@showLogin')->name('admin.login')->middleware('admin.login');
    Route::post('/admin/login', 'AdminController@login')->name('admin.login');
    Route::get('login/{provider}', 'UserController@redirectToProvider')->name('login.social.provider');
    Route::get('login/{provider}/callback', 'UserController@handleProviderCallback')->name('login.social.handle');
    Route::get('/browse', 'PostController@browsePost')->name('post.browse');
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
            Route::get('/{slug}', 'PostController@show')->name('admin.post.show');
            Route::get('/{slug}/publish', 'PostController@publishPost')->name('admin.post.publish');
            Route::delete('/{slug}', 'PostController@delete')->name('admin.post.delete');
            Route::get('/restore/{slug}', 'PostController@restore')->name('admin.post.restore');
        });
    });
    Route::get('/password', 'AdminController@showPassword')->name('admin.password');
    Route::post('/password', 'AdminController@storePassword')->name('admin.password.store');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/test', function() {
    return view('Post.template');
});
