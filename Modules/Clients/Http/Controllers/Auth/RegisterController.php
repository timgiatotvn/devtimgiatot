<?php

namespace Modules\Clients\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Model\TokenEmail;
use App\Model\User;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\ClientUserService;
use App\Service\Clients\SettingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
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
            $checkCode = DB::table('verify_codes')->where('code', $request->verify_code)
                                                  ->first();
            
            if (empty($checkCode)) {
                return back()->withInput($request->all())->withErrors(['accountNotFound' => 'Mã xác thực không hợp lệ']);
            }
            if ($this->clientUserService->store($request->all())){
                session()->flash('success', __('clients::layer.user.register.success'));
                return redirect(route('client.user.login'));
            } else {
                $errors = new MessageBag(['accountNotFound' => __('clients::layer.user.register.error')]);
                return back()->withInput($request->all())->withErrors($errors);
            }
        } catch (\Exception $e) {
            $errors = new MessageBag(['accountNotFound' => $e->getMessage()]);
            return back()->withInput([])->withErrors($errors);
        }
    }

    public function verify($token)
    {
        try {
            $checkToken = TokenEmail::where('token', $token)->first();

            if (empty($checkToken)) {
                return redirect()->route('client.user.login')->with('error', 'Token không tồn tại');
            }
            $time_expire = time() - strtotime($checkToken->created_at);

            if ($time_expire/60 <= 20) {
                DB::beginTransaction();
                User::whereId($checkToken->user_id)
                    ->update([
                        'email_verify' => date('Y-m-d H:i:s')
                    ]);
                $checkToken->delete();
                DB::commit();
                session()->flash('success', 'Xác thực thành công, vui lòng đăng nhập');

                return redirect()->route('client.user.login');
            } else {
                $checkToken->delete();

                return redirect()->route('client.user.login')->with('error', 'Token hết hạn');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        
    }
}
