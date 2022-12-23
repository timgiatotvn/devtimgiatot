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
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => 'check-auth'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
    Route::get('/delete', [
        'uses' => '\UniSharp\LaravelFilemanager\Controllers\DeleteController@getDelete',
        'as' => 'getDelete',
    ])->middleware('check-auth-admin');
    
});
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

Route::group(['prefix' => 'nguoi-ban', 'middleware' => 'check-login-seller', 'as' => 'seller.'], function () {
    Route::get('/', 'SellerController@index')->name('index');
    Route::post('/update-name-shop', 'SellerController@updateNameShop')->name('update-name-shop');
    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/list', 'SellerController@listProduct')->name('list');
        Route::get('/add', 'SellerController@formAddProduct')->name('form-add-product');
        Route::get('/{id}/edit', 'SellerController@formEditProduct')->name('form-edit-product');
        Route::post('/store-product', 'SellerController@storeProduct')->name('store-product');
        Route::post('{id}/update-product', 'SellerController@updateProduct')->name('update-product')->middleware('check-owner-product');
        Route::get('/{id}/delete', 'SellerController@deleteProduct')->name('delete-product')->middleware('check-owner-product');
    });
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/list', 'SellerController@listOrder')->name('list');
    });
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
            Route::get('/post', 'UsersController@viewPost')->name('client.user.post');
            Route::get('/post/{id}/edit', 'UsersController@viewFormEdit')->name('client.user.edit');
            Route::post('/post/{id}/update', 'UsersController@updatePost')->name('client.user.update-post');
            Route::get('/post/create', 'UsersController@createPost')->name('client.user.create-post');
            Route::post('/post/store', 'UsersController@storePost')->name('client.user.store-post');
            Route::get('/post/{id}/delete', 'UsersController@deletePost')->name('client.user.delete-post');
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
        Route::get('/payment/{code}', 'CartController@payment')->name('client.cart.payment');
    });

    //contact
    Route::get('/lien-he', 'ContactController@create')->name('client.contact.create');
    Route::post('/lien-he', 'ContactController@store');
    Route::post('/get-district', 'CategoriesController@getDistrict')->name('client.service.get_district');
    //feed product
    Route::get('/product-feed', 'ProductsController@feed');
    Route::post('/add-advise-request', 'CategoriesController@addAdviseRequest')->name('client.add_advise_request');
    //base
    Route::get('/', 'HomeController@index')->name('client.home');
    Route::get('/so-sanh-gia/{slug}.htm', 'ProductsController@showSosanh')->name('client.product.showSosanh');
    Route::get('/{slug}.htm', 'ProductsController@show')->name('client.product.show');
    Route::get('/{slug}.html', 'PostsController@show')->name('client.post.show');
    Route::get('/search', 'CategoriesController@search')->name('client.category.search');
    Route::get('/dich-vu', 'CategoriesController@serviceCategory')->name('client.service.category');
    Route::get('/dich-vu/tim-kiem', 'CategoriesController@resultSearchService')->name('client.result_search_service');
    Route::post('/load-more-category-service', 'CategoriesController@loadMoreCategoryService')->name('client.load_more_category_service');
    Route::post('/load-more-service-relate', 'CategoriesController@loadMoreServiceRelate')->name('client.load_more_service_relate');
    Route::get('/dich-vu/{slug}', 'CategoriesController@listService')->name('client.service.list');
    Route::get('/dich-vu/{category}/{slug}-{id}', 'CategoriesController@detailService')->name('client.service.detail')->where(array('slug' => '[a-z0-9\-]+', 'id' => '[0-9]+'));
    Route::get('/{slug}', 'CategoriesController@index')->name('client.category.index');
    Route::get('/crawl/data', 'CrawlController@crawlData');
});
