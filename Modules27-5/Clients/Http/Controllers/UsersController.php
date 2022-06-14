<?php

namespace Modules\Clients\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCartService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\ClientUserService;
use App\Service\Clients\SettingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Modules\Clients\Http\Requests\User\UpdateRequest;

class UsersController extends Controller
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $clientCartService;
    private $clientUserService;
    private $setting;

    public function __construct(SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService,
                                ClientPostService $clientPostService,
                                ClientCartService $clientCartService,
                                ClientUserService $clientUserService
    )
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;
        $this->clientPostService = $clientPostService;
        $this->clientCartService = $clientCartService;
        $this->clientUserService = $clientUserService;

        $this->setting = $this->clientSettingService->findFirst();
        View::share('data_common', ['logo' => $this->clientAdvService->findByLogo(), 'setting' => $this->setting, 'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1]), 'page_user' => '1']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('clients::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('clients::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show info
     * @method GET
     */
    public function show()
    {
        try {
            $data['detail'] = $this->clientUserService->getAuthUser();
            $data['common'] = Helpers::metaHead((object)["title_seo" => "Thông tin"]);
            return view('clients::users.show', ['data' => $data]);
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    /**
     * Update data
     * @method POST
     */
    public function update(UpdateRequest $request)
    {
        try {
            if ($this->clientUserService->update($request->all())) {
                session()->flash('success', __('clients::layer.user.success'));
                return redirect(route('client.user.show'));
            }else{
                $errors = new MessageBag(['accountNotFound' => __('clients::layer.user.error')]);
                return back()->withInput($request->all())->withErrors($errors);
            }
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * User logout
     * @method GET
     */
    public function logout()
    {
        try{
            Auth::guard(Helpers::renderGuard(1))->logout();
            return redirect()->route('client.user.login');
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
