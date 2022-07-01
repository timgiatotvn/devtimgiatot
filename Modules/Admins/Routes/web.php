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

        Route::post('/render-slug', 'CommonController@renderSlug')->name('admin.renderSlug');

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

        //Logo
        Route::prefix('logos')->group(function () {
            Route::get('/', 'LogosController@index')->name('admin.logo.index');
            Route::get('/create', 'LogosController@create')->name('admin.logo.create');
            Route::post('/create', 'LogosController@store');
            Route::get('/edit/{id}', 'LogosController@edit')->name('admin.logo.edit');
            Route::post('/edit/{id}', 'LogosController@update');
            Route::get('/status/{id}/{status}', 'LogosController@status')->name('admin.logo.status');
            Route::get('/show/{id}', 'LogosController@show')->name('admin.logo.show');
            Route::get('/destroy/{id}', 'LogosController@destroy')->name('admin.logo.destroy');
        });

        //Logo
        Route::prefix('slideshows')->group(function () {
            Route::get('/', 'SlideshowsController@index')->name('admin.slideshow.index');
            Route::get('/create', 'SlideshowsController@create')->name('admin.slideshow.create');
            Route::post('/create', 'SlideshowsController@store');
            Route::get('/edit/{id}', 'SlideshowsController@edit')->name('admin.slideshow.edit');
            Route::post('/edit/{id}', 'SlideshowsController@update');
            Route::get('/status/{id}/{status}', 'SlideshowsController@status')->name('admin.slideshow.status');
            Route::get('/show/{id}', 'SlideshowsController@show')->name('admin.slideshow.show');
            Route::get('/destroy/{id}', 'SlideshowsController@destroy')->name('admin.slideshow.destroy');
        });

        //Logo
        Route::prefix('links')->group(function () {
            Route::get('/', 'LinksController@index')->name('admin.link.index');
            Route::get('/create', 'LinksController@create')->name('admin.link.create');
            Route::post('/create', 'LinksController@store');
            Route::get('/edit/{id}', 'LinksController@edit')->name('admin.link.edit');
            Route::post('/edit/{id}', 'LinksController@update');
            Route::get('/status/{id}/{status}', 'LinksController@status')->name('admin.link.status');
            Route::get('/show/{id}', 'LinksController@show')->name('admin.link.show');
            Route::get('/destroy/{id}', 'LinksController@destroy')->name('admin.link.destroy');
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
            Route::post('/', 'PostsController@actionIndex');
            Route::get('/create', 'PostsController@create')->name('admin.post.create');
            Route::post('/create', 'PostsController@store');
            Route::get('/edit/{id}', 'PostsController@edit')->name('admin.post.edit');
            Route::post('/edit/{id}', 'PostsController@update');
            Route::get('/status/{id}/{field}', 'PostsController@status')->name('admin.post.status');
            Route::get('/show/{id}', 'PostsController@show')->name('admin.post.show');
            Route::get('/destroy/{id}', 'PostsController@destroy')->name('admin.post.destroy');
        });

        //Products
        Route::prefix('products')->group(function () {
            Route::get('/', 'ProductsController@index')->name('admin.product.index');
            Route::post('/', 'ProductsController@actionIndex');
            Route::get('/create', 'ProductsController@create')->name('admin.product.create');
            Route::post('/create', 'ProductsController@store');
            Route::get('/edit/{id}', 'ProductsController@edit')->name('admin.product.edit');
            Route::post('/edit/{id}', 'ProductsController@update');
            Route::get('/status/{id}/{field}', 'ProductsController@status')->name('admin.product.status');
            Route::get('/show/{id}', 'ProductsController@show')->name('admin.product.show');
            Route::get('/destroy/{id}', 'ProductsController@destroy')->name('admin.product.destroy');
        });

        //Products crawlers
        Route::prefix('product-crawlers')->group(function () {
                Route::get('/', 'ProductCrawlersController@index')->name('admin.productCrawler.index');
            Route::post('/', 'ProductCrawlersController@actionIndex');
            Route::get('/create', 'ProductCrawlersController@create')->name('admin.productCrawler.create');
            Route::post('/create', 'ProductCrawlersController@store');
            Route::get('/edit/{id}', 'ProductCrawlersController@edit')->name('admin.productCrawler.edit');
            Route::post('/edit/{id}', 'ProductCrawlersController@update');
            Route::get('/status/{id}/{field}', 'ProductCrawlersController@status')->name('admin.productCrawler.status');
            Route::get('/show/{id}', 'ProductCrawlersController@show')->name('admin.productCrawler.show');
            Route::get('/destroy/{id}', 'ProductCrawlersController@destroy')->name('admin.productCrawler.destroy');
        });

        //Products
        Route::prefix('carts')->group(function () {
            Route::get('/', 'CartsController@index')->name('admin.cart.index');
        });

        // Cấu hình
        Route::get('/settings/{id}', 'SettingsController@edit')->name('admin.setting.update');
        Route::post('/settings/{id}', 'SettingsController@update');

        //Crawler
        Route::prefix('crawlers')->group(function () {
            Route::prefix('websites')->group(function () {
                Route::get('/', 'Crawlers\WebsitesController@index')->name('admin.crawler.website.index');
                Route::get('/create', 'Crawlers\WebsitesController@create')->name('admin.crawler.website.create');
                Route::post('/create', 'Crawlers\WebsitesController@store');
                Route::get('/edit/{id}', 'Crawlers\WebsitesController@edit')->name('admin.crawler.website.edit');
                Route::post('/edit/{id}', 'Crawlers\WebsitesController@update');
                Route::get('/status/{id}/{field}', 'Crawlers\WebsitesController@status')->name('admin.crawler.website.status');
                Route::get('/show/{id}', 'Crawlers\WebsitesController@show')->name('admin.crawler.website.show');
                Route::get('/destroy/{id}', 'Crawlers\WebsitesController@destroy')->name('admin.crawler.website.destroy');
            });

            Route::prefix('categories')->group(function () {
                Route::get('/{crawler_website_id}', 'Crawlers\CategoriesController@index')->name('admin.crawler.category.index');
                Route::get('/{crawler_website_id}/create', 'Crawlers\CategoriesController@create')->name('admin.crawler.category.create');
                Route::post('/{crawler_website_id}/create', 'Crawlers\CategoriesController@store');
                Route::get('/{crawler_website_id}/edit/{id}', 'Crawlers\CategoriesController@edit')->name('admin.crawler.category.edit');
                Route::post('/{crawler_website_id}/edit/{id}', 'Crawlers\CategoriesController@update');
                Route::get('/{crawler_website_id}/status/{id}/{field}', 'Crawlers\CategoriesController@status')->name('admin.crawler.category.status');
                Route::get('/{crawler_website_id}/show/{id}', 'Crawlers\CategoriesController@show')->name('admin.crawler.category.show');
                Route::get('/{crawler_website_id}/destroy/{id}', 'Crawlers\CategoriesController@destroy')->name('admin.crawler.category.destroy');
                Route::get('/{crawler_website_id}/crawler-setup/{id}', 'Crawlers\CategoriesController@crawlerSetup')->name('admin.crawler.category.crawlerSetup');
            });

            Route::prefix('articles')->group(function () {
                Route::get('/', 'Crawlers\ArticlesController@index')->name('admin.crawler.article.index');
            });
        });

	//notification
        Route::resource('notification', 'NotificationController');
        Route::get('notification/delete/{id}', 'NotificationController@destroy')->name('admin.notification.destroy');
    });
});
