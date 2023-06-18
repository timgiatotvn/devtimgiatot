<?php

namespace Modules\Clients\Http\Controllers;

use App\Helpers\Helpers;
use App\Model\Category;
use App\Model\CategoryWp;
use App\Model\Widget;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $setting;

    public function __construct(SettingService        $clientSettingService,
                                AdvertisementService  $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService  $clientProductService,
                                ClientPostService     $clientPostService
    )
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;
        $this->clientPostService = $clientPostService;

        $this->setting = $this->clientSettingService->findFirst();
        View::share('data_common', ['logo' => $this->clientAdvService->findByLogo(), 'setting' => $this->setting, 'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1])]);
    }

    public function index()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://timgiatot.vn/blog/wp-json/wp/v2/posts?_embed&categories=49');
            $data["news_coupon"] = json_decode($response->getBody()->getContents(), true);
            //dd($data["news_coupon"]);
            $response = $client->request('GET', 'https://timgiatot.vn/blog/wp-json/wp/v2/posts?_embed');
            $data["news_most_search"] = array_slice(json_decode($response->getBody()->getContents(), true), 0, 8);
            //dd($data["news_most_search"]);
            $cate_tim_gia_tot = Category::where('slug', 'tim-gia-tot')->first();
            $data['ads_home'] = \DB::table('advertisements')
                                   ->select('id', 'title', 'thumbnail', 'url', 'type')
                                   ->where('type', 'slideshow')
                                   ->where('status', 1)
                                   ->inRandomOrder()
                                   ->first();
            $data['category_products'] = Category::where('parent_id', $cate_tim_gia_tot->id)
                                                 ->where('type', 'product')
                                                 ->with(['category' => function ($query) {
                                                    $query->with('category');
                                                 }])
                                                 ->oldest('sort')
                                                 ->get();
            $data["widget"] = Widget::latest()->get()->keyBy("name");
            $data["categories"] = CategoryWp::oldest("position")->get()->toArray();
            // dd($data["categories"]);
            return view('clients::home.index', [
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            abort('500');
        }
    }

    /**
     * Page Home
     * @method GET
     */
    public function indexOld()
    {
        try {
            $data['setting'] = $this->setting;
            $data['common'] = Helpers::metaHead($data['setting']);
            $data['slide'] = $this->clientAdvService->getListSlideShow();
            $data['link'] = $this->clientAdvService->getListLink();
            $data['products'] = $this->clientProductService->getListHome(['limit' => 6]);
            $data['kienthuc'] = $this->clientPostService->getListByCategory(['category_id' => $this->clientCategoryService->multiCate(3)]);
            $data['news'] = $this->clientPostService->getListByCategory(['category_id' => $this->clientCategoryService->multiCate(20)]);
            $data['cat_kienthuc'] = $this->clientCategoryService->findById(3);
            $data['cat_tintuc'] = $this->clientCategoryService->findById(20);
            
            $data['ads_home'] = \DB::table('advertisements')
                                   ->select('id', 'title', 'thumbnail', 'url', 'type')
                                   ->where('type', 'slideshow')
                                   ->where('status', 1)
                                   ->inRandomOrder()
                                   ->first();
            //$data['ads_home'] = $this->clientAdvService->getListAdsLimit(['limit' => 4]);
            $data['page_home'] = true;
            $cate_tim_gia_tot = Category::where('slug', 'tim-gia-tot')->first();
            $data['category_products'] = Category::where('parent_id', $cate_tim_gia_tot->id)
                                                 ->where('type', 'product')
                                                 ->with(['category' => function ($query) {
                                                    $query->with('category');
                                                 }])
                                                 ->oldest('sort')
                                                 ->get();
                                                 //dd($data['category_products']);
            $list_cate_show = DB::table('categories_show')
                ->where('status', 1)
                ->orderBy('id')
                ->get();
            $data_cate = [];
            foreach ($list_cate_show as $cate_show) {
                $cateId = $this->clientCategoryService->multiCate($cate_show->cate_id);
                $cateName = DB::table('categories')
                    ->select('title','slug')
                    ->where('id', $cate_show->cate_id)
                    ->first();
                $list_product = $this->clientProductService->getListByCate(['cate_multi' => $cateId, 'limit' => 12]);
                $dataSet = array(
                    'name' => $cateName->title,
                    'slug' => $cateName->slug,
                    'data' => $list_product
                );
                array_push($data_cate, $dataSet);
            }
            $data['cate'] = $data_cate;
            return view('clients::home.index', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
