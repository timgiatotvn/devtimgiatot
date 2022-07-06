<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/api', function (Request $request) {
//    return $request->user();
//});

Route::middleware('authApiRequest')->prefix('v1')->group(function(){
    Route::prefix('article')->group(function () {
        Route::post('/store', 'ArticleController@store');
        Route::post('/change-completed-at', 'ArticleController@storeCompletedAt');
    });
});


Route::middleware('authenticationMobileApp')->group(function(){
    Route::post('setup', 'HomeController@setup');
    Route::post('setup-app-version', 'HomeController@setupAppVersion');
    Route::get('home', 'HomeController@index');
    Route::get('category/{id}', 'HomeController@category');
    Route::get('product-by-category/{id}', 'ProductController@getProductByCategory');
    Route::get('product/{id}', 'ProductController@show');
    Route::get('product-compare-price/{id}', 'ProductController@comparePrice');
    Route::get('search', 'ProductController@search');
    Route::get('get-post-category/{id}', 'PostController@index');
    Route::get('post/{id}', 'PostController@show')->name('api.post.show');

    Route::get('notification', 'NotificationController@index');
    Route::get('notification/{id}', 'NotificationController@show')->name('api.notification.show');

    Route::get('category', 'CategoryController@index');
    Route::post('store', 'ProductController@store');
});