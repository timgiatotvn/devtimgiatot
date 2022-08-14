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
    $html = file_get_html_custom('https://nhathuoclongchau.com/thuc-pham-chuc-nang/ho-tro-mien-dich-tang-suc-de-khang?page=3&loadMore=true&sort=mua-nhieu-nhat&currentLink=thuc-pham-chuc-nang%2Fho-tro-mien-dich-tang-suc-de-khang');
    echo $html;
    dd(1);
    $client = new \GuzzleHttp\Client();
    $request = $client->request('GET', 'https://api.accesstrade.vn/v1/datafeeds?domain=tiki.vn&limit=3', [
        'headers' => [
            'Authorization' => 'Token zOKcSb-ZE9pHuwPgiNw8MrclrBXW9qhY',
            'Content-Type'     => 'application/json',
        ]
    ]);
    $data = json_decode($request->getBody()->getContents(), true);
    foreach ($data['data'] as $dataItem) {
        $data_insert[] = [
            'crawler_category_id' => 1,
            'admin_id' => 1,
            'name' => $dataItem['name'],
            'slug' => str_slug(($dataItem['name'])),
            'price' => $dataItem['price'],
            'price_root' => $dataItem['price'],
            'description' => str_replace("\n", "<br>", $dataItem['desc']),
            //'image' => $dataItem['image'],
            //'category_id' => 62,
            'status' => 1,
            'type' => 'crawler',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }
    \App\Model\Article::insert($data_insert);
    dd(1);
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function (\App\Service\UserService $userService) {
    return response()->json($userService->getUserById(222),200) ;
});