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

Route::feeds();

Route::get('/ma-xac-thuc', function () {
    $rand = rand() + time() - rand(0, 99);
    $code = substr($rand, rand(0, 4), 5);
    $checkExistCode = \DB::table('verify_codes')->where('code', $code)->first();

    if (empty($checkExistCode)) {
        \DB::table('verify_codes')->insert([
            'code' => $code,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return view('clients::verify_code', ['code' => $code]);
    }
});

Route::prefix('')->group(function() {
    //user
    Route::prefix('users')->group(function () {
        Route::get('/dang-nhap', 'Auth\LoginController@login')->name('client.user.login');
        Route::post('/dang-nhap', 'Auth\LoginController@postLogin');
        Route::get('/dang-ky', 'Auth\RegisterController@register')->name('client.user.register');
        Route::post('/dang-ky', 'Auth\RegisterController@store');
        Route::get('/{token}/verify', 'Auth\RegisterController@verify')->name('client.user.verify');

        Route::group(['middleware' => 'user'], function () {
            Route::get('/show', 'UsersController@show')->name('client.user.show');
            Route::post('/update', 'UsersController@update')->name('client.user.update');
            Route::get('/logout', 'UsersController@logout')->name('client.user.logout');
            Route::get('/notification', 'UsersController@viewNotification')->name('client.user.notification');
            Route::get('/notification/create', 'UsersController@createNotification')->name('client.user.notification.create');
            Route::get('/notification/{id}/delete', 'UsersController@deleteNoti')->name('client.user.notification.delete');
            Route::get('/notification/{id}/edit', 'UsersController@editNoti')->name('client.user.notification.edit');
            Route::post('/notification/{id}/update', 'UsersController@updateNoti')->name('client.user.notification.update');
            Route::post('/notification/store', 'UsersController@storeNotification')->name('client.user.notification.store');
            //cart
            Route::prefix('cart')->group(function () {
                //Route::post('/store', 'CartController@store')->name('client.card.store');
            });
        });
    });

    //cart
    Route::prefix('cart')->group(function () {
        Route::get('/', 'CartController@index')->name('client.card.index');
        Route::get('/create/{id}', 'CartController@create')->name('client.card.create');
        Route::post('/store', 'CartController@store')->name('client.card.store');
        Route::post('/update/{id}', 'CartController@update')->name('client.card.update');
        Route::get('/destroy/{id}', 'CartController@destroy')->name('client.card.destroy');
    });

    //contact
    Route::get('/lien-he', 'ContactController@create')->name('client.contact.create');
    Route::post('/lien-he', 'ContactController@store');

    //feed product
    Route::get('/product-feed', 'ProductsController@feed');

    //base
    Route::get('/', 'HomeController@index')->name('client.home');
    Route::get('/so-sanh-gia/{slug}.htm', 'ProductsController@showSosanh')->name('client.product.showSosanh');
    Route::get('/{slug}.htm', 'ProductsController@show')->name('client.product.show');
    Route::get('/{slug}.html', 'PostsController@show')->name('client.post.show');
    Route::get('/search', 'CategoriesController@search')->name('client.category.search');
    Route::get('/{slug}', 'CategoriesController@index')->name('client.category.index');
    Route::get('/crawl/data', 'CrawlController@crawlData');
});
