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
        Route::get("/danh-muc-wordpress", 'CategoryWordpressController@index')->name("category_wp.index");
        Route::get("/danh-muc-wordpress/create", 'CategoryWordpressController@create')->name("category_wp.create");
        Route::post("/danh-muc-wordpress/store", 'CategoryWordpressController@store')->name("category_wp.store");
        Route::get("/danh-muc-wordpress/{id}/edit", 'CategoryWordpressController@edit')->name("category_wp.edit");
        Route::get("/danh-muc-wordpress/{id}/delete", 'CategoryWordpressController@delete')->name("category_wp.delete");
        Route::post("/danh-muc-wordpress/{id}/update", 'CategoryWordpressController@update')->name("category_wp.update");
        Route::get('/widget', 'WidgetController@index')->name("widget.index");
        Route::get('/widget/{name}/widget', 'WidgetController@edit')->name("widget.edit");
        Route::post('/widget/{name}/store', 'WidgetController@store')->name("widget.store");
        Route::post("/widget/{name}/update", "WidgetController@update")->name("widget.update");
        Route::get("/widget/{name}/{id}/delete", "WidgetController@delete")->name("widget.delete");
        Route::get('/sign-out', 'Auth\LoginController@index')->name('admin.logout');
        Route::get('/', 'AdminsController@index')->name('admin.index');

        Route::post('/render-slug', 'CommonController@renderSlug')->name('admin.renderSlug');

        //Account
        Route::get('/accounts/logout', 'AccountsController@logout')->name('admin.account.logout');
        Route::prefix('accounts')->middleware('check-is-admin')->group(function () {
            Route::get('/', 'AccountsController@index')->name('admin.account.index');
            Route::get('/create', 'AccountsController@create')->name('admin.account.create');
            Route::post('/create', 'AccountsController@store');
            Route::get('/edit/{id}', 'AccountsController@edit')->name('admin.account.edit');
            Route::post('/edit/{id}', 'AccountsController@update');
            Route::get('/status/{id}/{status}', 'AccountsController@status')->name('admin.account.status');
            Route::get('/show/{id}', 'AccountsController@show')->name('admin.account.show');
            Route::get('/destroy/{id}', 'AccountsController@destroy')->name('admin.account.destroy');
        });

        // Crawl
        Route::prefix('crawls')->middleware('check-is-admin')->group(function () {
            Route::get('/list', 'CrawlController@list')->name('admin.crawls.list');
            Route::post('/store-link', 'CrawlController@storeLink')->name('admin.crawls.store-link');
        });

        Route::prefix('service')->middleware('check-is-admin')->group(function () {
            Route::get('/list', 'ServiceController@list')->name('admin.service.index');
            Route::get('/add', 'ServiceController@add')->name('admin.service.add');
            Route::post('/store', 'ServiceController@storeService')->name('admin.service.store');
            Route::get('/{id}/edit', 'ServiceController@edit')->name('admin.service.edit');
            Route::post('/{id}/update', 'ServiceController@updateService')->name('admin.service.update');
            Route::get('/{id}/delete', 'ServiceController@delete')->name('admin.service.delete');
            Route::post('/get-district', 'ServiceController@getDistrict')->name('admin.service.get_district');
        });

        Route::prefix('request')->middleware('check-is-admin')->group(function () {
            Route::get('/', 'ServiceController@listRequestAdvise')->name('admin.request.index');
        });

        //Advertisement
        Route::prefix('advertisements')->middleware('check-is-admin')->group(function () {
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
        Route::prefix('logos')->middleware('check-is-admin')->group(function () {
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
        Route::prefix('slideshows')->middleware('check-is-admin')->group(function () {
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
        Route::prefix('links')->middleware('check-is-admin')->group(function () {
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
        Route::prefix('categories')->middleware('check-is-admin')->group(function () {
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
            Route::get('/edit/{id}', 'PostsController@edit')->name('admin.post.edit')->middleware('check-owner-post');
            Route::post('/edit/{id}', 'PostsController@update')->middleware('check-owner-post');
            Route::get('/status/{id}/{field}', 'PostsController@status')->name('admin.post.status')->middleware('check-owner-post');
            Route::get('/show/{id}', 'PostsController@show')->name('admin.post.show')->middleware('check-owner-post');
            Route::get('/destroy/{id}', 'PostsController@destroy')->name('admin.post.destroy')->middleware('check-is-admin');
        });

        //Products
        Route::prefix('products')->middleware('check-is-admin')->group(function () {
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

        //keywords
        Route::prefix('keywords')->middleware('check-is-admin')->group(function () {
            Route::get('/', 'ProductsController@getListKeyWord')->name('admin.statistical.keyword');
        });

        //Cấu hình
        Route::prefix('config')->middleware('check-is-admin')->group(function () {
            //Danh mục hiển thị ngoài trang chủ
            Route::get('/home-cate', 'ConfigController@configCateHome')->name('admin.config.home-cate');
            Route::post('/setvalue', 'ConfigController@setvalue')->name('admin.config.setvalue');

            // Cấu hình
            Route::get('/settings/{id}', 'SettingsController@edit')->name('admin.config.setting.update');
            Route::post('/settings/{id}', 'SettingsController@update');

            //ảnh quảng cáo trong mỗi bài viết
            Route::get('/post-adv', 'ConfigController@configPostAdv')->name('admin.config.post-adv');
            Route::post('/post-adv', 'ConfigController@setValuePostAdv')->name('admin.config.set-value-post-adv');

            Route::get('/smtp', 'SmtpController@config')->name('admin.config.smtp');
            Route::post('/smtp-update', 'SmtpController@update')->name('admin.config.update-smtp');
            Route::get('/payment', 'SettingsController@viewConfigPayment')->name('admin.config.payment');
            Route::post('/store-payment', 'SettingsController@storePayment')->name('admin.config.store-payment');
            Route::get('/template-email', 'ConfigController@listTemplateEmail')->name('admin.config.list-template-email');
            Route::get('/add-template-email', 'ConfigController@viewAddTemplateEmail')->name('admin.config.add-template-email');
            Route::post('/store-template-email', 'ConfigController@storeTemplateEmail')->name('admin.config.store-template-email');
            Route::get('/{id}/edit-template-email', 'ConfigController@viewEditTemplateEmail')->name('admin.config.edit-template-email');
            Route::post('/{id}/update-template-email', 'ConfigController@updateTemplateEmail')->name('admin.config.update-template-email');
            Route::get('/{id}/delete-template-email', 'ConfigController@deleteTemplateEmail')->name('admin.config.delete-template-email');
        });

        //Products crawlers
        Route::prefix('product-crawlers')->middleware('check-is-admin')->group(function () {
            Route::get('/', 'ProductCrawlersController@index')->name('admin.productCrawler.index');
            Route::post('/', 'ProductCrawlersController@actionIndex');
            Route::get('/cr', 'ProductCrawlersController@indexCR')->name('admin.productCrawler.cr');
            Route::post('/cr', 'ProductCrawlersController@indexCR');
            Route::get('/create', 'ProductCrawlersController@create')->name('admin.productCrawler.create');
            Route::post('/create', 'ProductCrawlersController@store');
            Route::get('/edit/{id}', 'ProductCrawlersController@edit')->name('admin.productCrawler.edit');
            Route::post('/edit/{id}', 'ProductCrawlersController@update');
            Route::get('/status/{id}/{field}', 'ProductCrawlersController@status')->name('admin.productCrawler.status');
            Route::get('/show/{id}', 'ProductCrawlersController@show')->name('admin.productCrawler.show');
            Route::get('/destroy/{id}', 'ProductCrawlersController@destroy')->name('admin.productCrawler.destroy');
        });

        //Products
        Route::prefix('carts')->middleware('check-is-admin')->group(function () {
            Route::get('/', 'CartsController@index')->name('admin.cart.index');
        });

        // Route::prefix('smtp')->middleware('check-is-admin')->group(function () {
        //     Route::get('/config', 'SmtpController@config')->name('admin.smtp.config');
        //     Route::post('/update', 'SmtpController@update')->name('admin.smtp.update');
        // });

        Route::prefix('customers')->middleware('check-is-admin')->group(function () {
            Route::get('/list', 'CustomerController@index')->name('admin.customer.index');
            Route::post('/{id}/update-push-number', 'CustomerController@updatePushNumber')->name('admin.customer.update-push-number');
            Route::get('/accept-seller', 'CustomerController@acceptSeller')->name('admin.accept-seller');
        });

        Route::group(['prefix' => 'seller'], function () {
            Route::get('/product', 'SellerController@listProduct')->name('admin.seller.product.list');
            Route::get('/change-status', 'SellerController@changeStatusProduct')->name('admin.seller.product.change-status');
        });
        //Crawler
        Route::prefix('crawlers')->middleware('check-is-admin')->group(function () {
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

        Route::prefix('setting')->middleware('check-is-admin')->group(function () {
            Route::prefix('role')->group(function () {
                Route::get('/list', 'RoleController@list')->name('admin.setting.role.list');
                Route::get('/add', 'RoleController@add')->name('admin.setting.role.add');
                Route::post('/create', 'RoleController@create')->name('admin.setting.role.create');
                Route::get('/{id}/delete', 'RoleController@delete')->name('admin.setting.role.delete');
                Route::get('/{id}/edit', 'RoleController@editForm')->name('admin.setting.role.edit_form');
                Route::post('/{id}/update', 'RoleController@update')->name('admin.setting.role.update');
            });
            Route::prefix('group-permission')->group(function () {
                Route::get('/list', 'GroupPermissionController@list')->name('admin.setting.group_permission.list');
                Route::get('/add', 'GroupPermissionController@add')->name('admin.setting.group_permission.add');
                Route::post('/create', 'GroupPermissionController@create')->name('admin.setting.group_permission.create');
                Route::get('/{id}/delete', 'GroupPermissionController@delete')->name('admin.setting.group_permission.delete');
                Route::get('/{id}/edit', 'GroupPermissionController@editForm')->name('admin.setting.group_permission.edit_form');
                Route::post('/{id}/update', 'GroupPermissionController@update')->name('admin.setting.group_permission.update');
            });
            Route::prefix('permission')->group(function () {
                Route::get('/list', 'PermissionController@list')->name('admin.setting.permission.list');
                Route::get('/add', 'PermissionController@add')->name('admin.setting.permission.add');
                Route::post('/create', 'PermissionController@create')->name('admin.setting.permission.create');
                Route::get('/{id}/delete', 'PermissionController@delete')->name('admin.setting.permission.delete');
                Route::get('/{id}/edit', 'PermissionController@editForm')->name('admin.setting.permission.edit_form');
                Route::post('/{id}/update', 'PermissionController@update')->name('admin.setting.permission.update');
            });
        });

	//notification
        Route::resource('notification', 'NotificationController')->middleware('check-is-admin');
        Route::get('notification/delete/{id}', 'NotificationController@destroy')->name('admin.notification.destroy')->middleware('check-is-admin');
        Route::get('report-install-app', 'ReportInstallAppController@index')->name('report_install_app')->middleware('check-is-admin');
    });
});
