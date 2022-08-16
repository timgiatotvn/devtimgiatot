<?php

namespace Modules\Clients\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientLoginService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Modules\Clients\Http\Requests\User\LoginRequest;

class LoginController extends Controller
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $clientLoginService;
    private $setting;

    public function __construct(SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService,
                                ClientPostService $clientPostService,
                                ClientLoginService $clientLoginService
    )
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;
        $this->clientPostService = $clientPostService;
        $this->clientLoginService = $clientLoginService;

        $this->setting = $this->clientSettingService->findFirst();
        View::share('data_common', ['logo' => $this->clientAdvService->findByLogo(), 'setting' => $this->setting, 'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1]), 'page_user' => '1']);
    }

    /**
     * Page login
     * @method GET
     */
    public function login()
    {
        try {
            if (Auth::guard(Helpers::renderGuard(1))->check()) return redirect()->route('client.user.show');
            $data['common'] = Helpers::metaHead((object)["title_seo" => "Đăng nhập"]);

            return view('clients::users.auth.login', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Login admin
     * @method POST
     */
    public function postLogin(LoginRequest $request)
    {
        try {
            $data = $request->all();
            $userAfterLogin = $this->clientLoginService->login($data);
            if (!$userAfterLogin) {
                $errors = new MessageBag(['accountNotFound' => __('clients::layer.user.login.error')]);
                return back()->withInput($data)->withErrors($errors);
            }
            if (auth('users')->user()->email_verify == '') {
                $errors = new MessageBag(['accountNotFound' => 'Chưa xác thực Email']);
                auth('users')->logout();
                
                return back()->withInput($data)->withErrors($errors);
            }
            return redirect()->route('client.user.show');
        } catch (\Exception $e) {
            abort('500');
        }
    }

}
