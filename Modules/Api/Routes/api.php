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