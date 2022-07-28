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
Route::get('/test1', function () {
    $client = new \GuzzleHttp\Client();
    $request = $client->request('GET', 'https://api.accesstrade.vn/v1/datafeeds?domain=shopee.vn&limit=1', [
        'headers' => [
            'Authorization' => 'Token zOKcSb-ZE9pHuwPgiNw8MrclrBXW9qhY',
            'Content-Type'     => 'application/json',
        ]
    ]);
    $data = json_decode($request->getBody()->getContents(), true);
    foreach ($data['data'] as $dataItem) {
        $data_insert[] = [
            'admin_id' => 1,
            'title' => $dataItem['name'],
            'slug' => str_slug(($dataItem['name'])),
            'price' => $dataItem['price'],
            'price_root' => $dataItem['price'],
            'description' => str_replace("\n", "<br>", $dataItem['desc']),
            //'image' => $dataItem['image'],
            'category_id' => 62,
            'status' => 0,
            'type' => 'crawler',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }
    \App\Model\Product::insert($data_insert);
    dd(1);
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function (\App\Service\UserService $userService) {
    return response()->json($userService->getUserById(222),200) ;
});