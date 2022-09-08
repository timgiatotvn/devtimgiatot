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
    echo file_get_html_custom('https://fptshop.com.vn/tin-tuc');
    // $s3 = \Storage::disk('s3')->getAdapter()->getClient();
    // dd($s3->getObjectUrl( env('AWS_BUCKET'), 'photos/chinh123.jpg' ));
    // if (\Storage::disk('s3')->exists('photos/chinh123.jpg')) {
    //     dd(Storage::disk('s3')->get('photos/chinh123.jpg'));
    // }
    // \Storage::disk('s3')->put('photos/chinh123.jpg', fopen('https://timgiatot.vn/img/w1200/h438/fill!photos/00-khuyenmai/sam-sung.jpg', 'r'));
    dd(1);
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