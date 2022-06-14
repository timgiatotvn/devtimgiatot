<?php

namespace Modules\Clients\Http\Controllers;

use App\Helpers\Helpers;
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
use App\Model\Setting;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
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
        View::share('data_common', ['logo' => $this->clientAdvService->findByLogo(), 'setting' => $this->setting, 'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1])]);
    }

    /**
     * Page Home
     * @method GET
     */
    public function index()
    {
        try {
            $data['setting'] = $this->setting;
            $data['common'] = Helpers::metaHead($data['setting']);
            $data['slide'] = $this->clientAdvService->getListSlideShow();
            $data['link'] = $this->clientAdvService->getListLink();
            $data['products'] = $this->clientProductService->getListHome(['limit' => 30]);
            $data['kienthuc'] = $this->clientPostService->getListByCategory(['category_id' => $this->clientCategoryService->multiCate(3)]);
            $data['news'] = $this->clientPostService->getListByCategory(['category_id' => $this->clientCategoryService->multiCate(20)]);
            $data['cat_kienthuc'] = $this->clientCategoryService->findById(3);
            $data['cat_tintuc'] = $this->clientCategoryService->findById(20);
            $data['ads_home'] = $this->clientAdvService->getListAdsLimit(['limit' => 4]);
            $data['page_home'] = true;

            return view('clients::home.index', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
