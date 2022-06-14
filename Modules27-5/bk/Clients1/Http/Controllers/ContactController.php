<?php

namespace Modules\Clients\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCartService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientContactService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Modules\Clients\Http\Requests\Contact\CreateRequest;

class ContactController extends Controller
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $clientCartService;
    private $clientContactService;
    private $setting;

    public function __construct(SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService,
                                ClientPostService $clientPostService,
                                ClientCartService $clientCartService,
                                ClientContactService $clientContactService
    )
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;
        $this->clientPostService = $clientPostService;
        $this->clientCartService = $clientCartService;
        $this->clientContactService = $clientContactService;

        $this->setting = $this->clientSettingService->findFirst();
        View::share('data_common', ['logo' => $this->clientAdvService->findByLogo(), 'setting' => $this->setting, 'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1]), 'page_user' => '1']);
    }


    /**
     * Page contact
     * @method GET
     */
    public function create()
    {
        try{
            $data['common'] = Helpers::metaHead((object)["title_seo" => "Liên hệ"]);
            return view('clients::contact.create', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Store contact
     * @method POST
     */
    public function store(CreateRequest $request)
    {
        try {
            if($this->clientContactService->store($request->all())){
                session()->flash('success', __('clients::layer.contact.success'));
                return redirect(route('client.contact.create'));
            }else{
                $errors = new MessageBag(['accountNotFound' => __('clients::layer.contact.error')]);
                return back()->withInput($request->all())->withErrors($errors);
            }
        } catch (\Exception $e) {
            $errors = new MessageBag(['accountNotFound' => $e->getMessage()]);
            return back()->withInput([])->withErrors($errors);
        }
    }

}
