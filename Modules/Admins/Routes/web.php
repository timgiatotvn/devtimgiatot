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

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::prefix('admin')->group(function () {
    Route::get('/sign-in', 'Auth\LoginController@login')->name('admin.login');
    Route::post('/sign-in', 'Auth\LoginController@postLogin');

//    Route::group(['middleware' => 'ckfinderAuth'], function () {
//        Route::get('/ckfinder/browser1', 'Auth\LoginController@browser')->name('admin.browser');
//    });

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/sign-out', 'Auth\LoginController@index')->name('admin.logout');
        Route::get('/', 'AdminsController@index')->name('admin.index');

        //Account
        Route::prefix('accounts')->group(function () {
            Route::get('/', 'AccountsController@index')->name('admin.account.index');
            Route::get('/create', 'AccountsController@create')->name('admin.account.create');
            Route::post('/create', 'AccountsController@store');
            Route::get('/edit/{id}', 'AccountsController@edit')->name('admin.account.edit');
            Route::post('/edit/{id}', 'AccountsController@update');
            Route::get('/status/{id}/{status}', 'AccountsController@status')->name('admin.account.status');
            Route::get('/show/{id}', 'AccountsController@show')->name('admin.account.show');
            Route::get('/destroy/{id}', 'AccountsController@destroy')->name('admin.account.destroy');
            Route::get('/logout', 'AccountsController@logout')->name('admin.account.logout');
        });

        //Advertisement
        Route::prefix('advertisements')->group(function () {
            Route::get('/', 'AdvertisementsController@index')->name('admin.advertisement.index');
            Route::get('/create', 'AdvertisementsController@create')->name('admin.advertisement.create');
            Route::post('/create', 'AdvertisementsController@store');
            Route::get('/edit/{id}', 'AdvertisementsController@edit')->name('admin.advertisement.edit');
            Route::post('/edit/{id}', 'AdvertisementsController@update');
            Route::get('/status/{id}/{status}', 'AdvertisementsController@status')->name('admin.advertisement.status');
            Route::get('/show/{id}', 'AdvertisementsController@show')->name('admin.advertisement.show');
            Route::get('/destroy/{id}', 'AdvertisementsController@destroy')->name('admin.advertisement.destroy');
        });

        //Danh muc
        Route::prefix('categories')->group(function () {
            Route::get('/', 'CategoriesController@index')->name('admin.category.index');
            Route::get('/create', 'CategoriesController@create')->name('admin.category.create');
            Route::post('/create', 'CategoriesController@store');
            Route::get('/edit/{id}', 'CategoriesController@edit')->name('admin.category.edit');
            Route::post('/edit/{id}', 'CategoriesController@update');
            Route::get('/status/{id}/{field}', 'CategoriesController@status')->name('admin.category.status');
            Route::get('/show/{id}', 'CategoriesController@show')->name('admin.category.show');
            Route::get('/destroy/{id}', 'CategoriesController@destroy')->name('admin.category.destroy');
        });

        //Bài viet
        Route::prefix('posts')->group(function () {
            Route::get('/', 'PostsController@index')->name('admin.post.index');
            Route::get('/create', 'PostsController@create')->name('admin.post.create');
            Route::post('/create', 'PostsController@store');
            Route::get('/edit/{id}', 'PostsController@edit')->name('admin.post.edit');
            Route::post('/edit/{id}', 'PostsController@update');
            Route::get('/status/{id}/{field}', 'PostsController@status')->name('admin.post.status');
            Route::get('/show/{id}', 'PostsController@show')->name('admin.post.show');
            Route::get('/destroy/{id}', 'PostsController@destroy')->name('admin.post.destroy');
        });

        //Sản phẩm
        Route::prefix('posts')->group(function () {
            Route::get('/', 'PostsController@index')->name('admin.post.index');
            Route::get('/create', 'PostsController@create')->name('admin.post.create');
            Route::post('/create', 'PostsController@store');
            Route::get('/edit/{id}', 'PostsController@edit')->name('admin.post.edit');
            Route::post('/edit/{id}', 'PostsController@update');
            Route::get('/status/{id}/{field}', 'PostsController@status')->name('admin.post.status');
            Route::get('/show/{id}', 'PostsController@show')->name('admin.post.show');
            Route::get('/destroy/{id}', 'PostsController@destroy')->name('admin.post.destroy');
        });

        // Cấu hình
        Route::get('/settings/{id}', 'SettingsController@edit')->name('admin.setting.update');
        Route::post('/settings/{id}', 'SettingsController@update');


    });
});
