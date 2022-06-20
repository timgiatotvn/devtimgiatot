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
Route::get('/123', function () {
    return '123';
    return view('welcome');
});

Route::get('/test', function (\App\Service\UserService $userService) {
    return response()->json($userService->getUserById(222),200) ;
});