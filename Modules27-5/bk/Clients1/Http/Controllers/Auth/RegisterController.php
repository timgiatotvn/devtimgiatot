<?php

namespace Modules\Clients\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\ClientUserService;
use App\Service\Clients\SettingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Modules\Clients\Http\Requests\User\RegisterRequest;

class RegisterController extends Controller
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $clientUserService;
    private $setting;

    public function __construct(SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService,
                                ClientPostService $clientPostService,
                                ClientUserService $clientUserService
    )
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;
        $this->clientPostService = $clientPostService;
        $this->clientUserService = $clientUserService;

        $this->setting = $this->clientSettingService->findFirst();
        View::share('data_common', ['logo' => $this->clientAdvService->findByLogo(), 'setting' => $this->setting, 'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1]), 'page_user' => '1']);
    }

    /**
     * Page Register
     * @method GET
     */
    public function register()
    {
        try {
            $data['common'] = Helpers::metaHead((object)["title_seo" => "Đăng ký"]);

            return view('clients::users.auth.register', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Page Register
     * @method POST
     */
    public function store(RegisterRequest $request)
    {
        try {
            if($this->clientUserService->store($request->all())){
                session()->flash('success', __('clients::layer.user.register.success'));
                return redirect(route('client.user.login'));
            }else{
                $errors = new MessageBag(['accountNotFound' => __('clients::layer.user.register.error')]);
                return back()->withInput($request->all())->withErrors($errors);
            }
        } catch (\Exception $e) {
            $errors = new MessageBag(['accountNotFound' => $e->getMessage()]);
            return back()->withInput([])->withErrors($errors);
        }
    }


}
