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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

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

            if ($data['category']->type == 'product') {
                $data['list'] = $this->clientProductService->getListByCate(['cate_multi' => $cateMulti, 'limit' => 20]);

                if (empty($data['category']->title_seo)) $data['category']->title_seo = "Giá " . $data['category']->title . " tốt nhất tháng " . date("m/Y", time());
                if (empty($data['category']->meta_des)) {
                    $des = !empty($data['category']->description) ? $data['category']->description : "";
                    $data['category']->meta_des = Helpers::shortDesc($des, 150);
                }
                $data['common'] = Helpers::metaHead($data['category']);

                return view('clients::products.index', ['data' => $data]);
            } else {
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

    public function search()
    {
        try {

	    $data['setting'] = $this->setting;
            $data['common'] = Helpers::metaHead($data['setting']);
            $data['search_title'] = !empty($_GET['key']) ? 'Tiếp tục mua hàng' : 'Tìm kiếm';
            $keyword = !empty($_GET['keyword']) ? $_GET['keyword'] : '';
	if($keyword ){

DB::table('key_words')->insert([
    'name' => $keyword]);
	}
            $data['list'] = $this->clientProductService->getListByCateSearch(['keyword' => $keyword, 'limit' => 20]);

            return view('clients::products.index', ['data' => $data]);
        } catch (\Exception $e) {
            Helpers::pre($e->getMessage());
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }
}
