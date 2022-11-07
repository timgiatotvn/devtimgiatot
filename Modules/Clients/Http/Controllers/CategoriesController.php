<?php

namespace Modules\Clients\Http\Controllers;

use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Model\Category;
use App\Model\Post;
use App\Helpers\Helpers;
use App\Model\AdviseRequest;
use App\Model\Service;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $setting;

    public function __construct(SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService,
                                ClientPostService $clientPostService
    )
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;
        $this->clientPostService = $clientPostService;
        $this->setting = $this->clientSettingService->findFirst();
        View::share('data_common', [
            'logo' => $this->clientAdvService->findByLogo(),
            'setting' => $this->setting,
            'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1]),
            'top_products' => $this->clientProductService->getListHome(['limit' => 8])
        ]);
    }

    public function index($slug)
    {
        try {
            $data['category'] = $this->clientCategoryService->findBySlug($slug);

            if (empty($data['category']->id)) abort(404);
            $data['setting'] = $this->setting;
            $cateMulti = $this->clientCategoryService->multiCate($data['category']->id);
            $data['news_coupon'] = Post::where('category_id', 20)->inRandomOrder()->take(6)->get();

            if ($data['category']->type == 'product') {
                $data['category_products'] = Category::where('parent_id', $data['category']->id)
                                                 ->where('type', 'product')
                                                 ->with(['category' => function ($query) {
                                                    $query->with('category');
                                                 }])
                                                 ->get();
                $data['list'] = $this->clientProductService->getListByCate(['cate_multi' => $cateMulti, 'limit' => 20]);

                if (empty($data['category']->title_seo)) $data['category']->title_seo = "Giá " . $data['category']->title . " tốt nhất tháng " . date("m/Y", time());
                if (empty($data['category']->meta_des)) {
                    $des = !empty($data['category']->description) ? $data['category']->description : "";
                    $data['category']->meta_des = Helpers::shortDesc($des, 150);
                }
                $data['common'] = Helpers::metaHead($data['category']);

                return view('clients::products.index', ['data' => $data]);
            } else {
                $data['category_products'] = Category::where('parent_id', $data['category']->id)
                                                 ->where('type', 'new')
                                                 ->with(['category' => function ($query) {
                                                    $query->with('category');
                                                 }])
                                                 ->get();
                if (empty($data['category']->title_seo)) $data['category']->title_seo = "Thông tin hữu ích về " . $data['category']->title . " - " . @ucfirst($_SERVER["HTTP_HOST"]);
                if (empty($data['category']->meta_des)) {
                    $des = !empty($data['category']->description) ? $data['category']->description : "";
                    $data['category']->meta_des = Helpers::shortDesc($des, 150);
                }
                $data['common'] = Helpers::metaHead($data['category']);

                $data['list'] = $this->clientPostService->getListByCate(['cate_multi' => $cateMulti, 'limit' => 15]);
                if (count($data['list']) == 1 && empty($_GET['page'])) {
                    return redirect(route('client.post.show', ['slug' => $data['list'][0]->slug]));
                }

                return view('clients::posts.index', ['data' => $data]);
            }
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    public function listService($slug, Request $request)
    {
        $services = Service::query();
        $districts = [];
        $category = Category::where('slug', $slug)->first();
        $services->where('category_id', $category->id)
                 ->where('status', 1);
        if (isset($request->province_id) && $request->province_id != -1) {
            $services->where('province_id', $request->province_id);
            $districts = DB::table('districts')->where('province_id', $request->province_id)->get();
        }
        if (isset($request->district_id) && $request->district_id != -1) {
            $services->where('district_id', $request->district_id);
        }
        if (isset($request->service_name) && $request->service_name != '') {
            $services->where('title', 'like', '%' . $request->service_name . '%');
        }
        $data['common'] = [
            'title_seo' => $category->title,
            'meta_des' => strip_tags($category->description)
        ];

        return view("clients::services.list", [
            'services' => $services->latest()->paginate(20),
            'inputs' => $request->all(),
            'category' => $category,
            'districts' => $districts,
            'provinces' => DB::table('provinces')->get(),
            'data' => $data
        ]);
    }

    public function resultSearchService(Request $request)
    {
        $services = Service::query();
        $services->where('status', 1);
        $districts = [];
        if (isset($request->province_id) && $request->province_id != -1) {
            $services->where('province_id', $request->province_id);
            $districts = DB::table('districts')->where('province_id', $request->province_id)->get();
        }
        if (isset($request->district_id) && $request->district_id != -1) {
            $services->where('district_id', $request->district_id);
        }
        if (isset($request->service_name) && $request->service_name != '') {
            $services->where('title', 'like', '%' . $request->service_name . '%');
        }
        $data['common'] = [
            'title_seo' => 'Kết quả tìm kiếm dịch vụ',
            'meta_des' => ''
        ];

        return view("clients::services.search", [
            'services' => $services->latest()->paginate(20),
            'inputs' => $request->all(),
            'districts' => $districts,
            'provinces' => DB::table('provinces')->get(),
            'data' => $data
        ]);
    }

    public function addAdviseRequest(Request $request)
    {
        AdviseRequest::create($request->except('_token'));

        return back();
    }

    public function detailService($category, $slug, $id)
    {
        $service = Service::where('slug', $slug)
                          ->where('id', $id)
                           ->first();
        $data['common'] = [
            'title_seo' => $service->title,
            'meta_des' => strip_tags($service->description)
        ];
        $serviceRelates = Service::where('id', '!=', $id)
                                 ->where('category_id', $service->category_id)
                                 ->latest()
                                 ->take(4)
                                 ->get();

        return view("clients::services.detail", [
            'service' => $service,
            'serviceRelates' => $serviceRelates,
            'data' => $data
        ]);
    }

    public function loadMoreServiceRelate(Request $request)
    {
        $serviceRelates = Service::where('category_id', $request->category_id)
                                 ->latest()
                                 ->offset($request->offset)
                                 ->take(4)
                                 ->get();
        $string = "";
        foreach ($serviceRelates as $item) {
            $link = route('client.service.detail', ['category' => $item->category->slug, 'slug' => $item->slug, 'id' => $item->id]);
            $description = strip_tags($item->description);
            $string.= "
            <div class='item-service-relate'>
                <div class='image-relate'>
                    <a href='$link'>
                        <img src='$item->thumbnail'>
                    </a>
                </div>
                <div class='panel-service'>
                    <h4>
                        <a class='a-none' href='$link'>$item->title</a>
                    </h4>
                    <p>
                        $description
                    </p>
                </div>
            </div>
            ";
        }

        return response()->json([
            'success' => true,
            'total' => count($serviceRelates),
            'string' => $string
        ]);
    }

    public function getDistrict(Request $request)
    {
        $districts = DB::table('districts')->where('province_id', $request->province_id)->get();
        
        return response()->json(['success' => true, 'data' => $districts]);
    }

    public function serviceCategory()
    {
        $categories = Category::where('type', 'service')
                             ->take(8)
                             ->oldest('sort')
                             ->get();

        return view("clients::services.category", [
            'categories' => $categories,
            'provinces' => DB::table('provinces')->get()
        ]);
    }

    public function loadMoreCategoryService(Request $request)
    {
        $categories = Category::where('type', 'service')
                              ->oldest('sort')
                              ->offset($request->offset)
                              ->take(4)
                              ->get();
        $string = "";
        foreach ($categories as $item) {
            $link = route('client.service.list', ['slug' => $item->slug]);
            $description = strip_tags($item->description);
            $string.= "<a href='$link' class='item-service'>
                            <div class='image-service'>
                                <img src='$item->thumbnail'>
                            </div>
                            <div class='panel-service'>
                                <h4 class='title'>$item->title</h4>
                                <p class='overview'>$description</p>
                            </div>
                        </a>";
        }

        return response()->json([
            'success' => true,
            'total' => count($categories),
            'string' => $string
        ]);
    }

    public function search()
    {
        try {
            $data['setting'] = $this->setting;
            $data['common'] = Helpers::metaHead($data['setting']);
            $data['search_title'] = !empty($_GET['key']) ? 'Tiếp tục mua hàng' : 'Tìm kiếm';
            $keyword = !empty($_GET['keyword']) ? $_GET['keyword'] : '';
            $data['keyword'] = $keyword;
            if($keyword){
                DB::table('key_words')->insert([
                    'name' => $keyword,
                ]);
            }
            $data['list'] = $this->clientProductService->getListByCateSearch(['keyword' => $keyword, 'limit' => 24]);

            //return view('clients::products.index', ['data' => $data]);
            return view('clients::searchs.index', ['data' => $data]);
        } catch (\Exception $e) {
            Helpers::pre($e->getMessage());
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }
}
