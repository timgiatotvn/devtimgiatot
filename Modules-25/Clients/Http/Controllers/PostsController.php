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
use App\Model\Post;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\View;

class PostsController extends Controller
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

    /**
     * Page show
     * @method GET
     */
    public function show($slug)
    {
        try {
            $data['detail'] = $this->clientPostService->findBySlug($slug);
            if (empty($data['detail']->id)) abort(404);
            $data['setting'] = $this->setting;
            $data['common'] = Helpers::metaHead($data['detail']);
            $data['cate_parent'] = !empty($data['detail']->category_parent_id) ? $this->clientCategoryService->findById($data['detail']->category_parent_id) : [];
            $data['related'] = $this->clientPostService->getListRelated(['category_id' => $data['detail']->category_id, 'id' => $data['detail']->id]);
            $data['regex'] = Helpers::hyperlinkContentRegex($data['detail']->content);
			$data['ftoc'] = true;
			
            return view('clients::posts.show', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

}
