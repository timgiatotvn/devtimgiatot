<?php

namespace Modules\Clients\Http\Controllers;

use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Model\Post;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\View;

class PostsController extends Controller
{
    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $setting;

    public function __construct(SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService
    )
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;

        $this->setting = $this->clientSettingService->findFirst();
        View::share('data_common', ['logo' => $this->clientAdvService->findByLogo(), 'setting' => $this->setting, 'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1])]);
    }

    /**
     * Page show
     * @method GET
     */
    public function show($slug)
    {
        try {
            return redirect(route('client.home'));
            $id = Helpers::renderID($slug);
            $data['setting'] = $this->setting;
            $data['common'] = Helpers::metaHead($data['setting']);

            return view('clients::posts.show', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

}
