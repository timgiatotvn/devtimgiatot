<?php

namespace Modules\Clients\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCartService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\ClientPostService;
use App\Service\Clients\ClientProductService;
use App\Service\Clients\SettingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Modules\Clients\Http\Requests\Cart\CreateRequest;

class CartController extends Controller
{

    private $clientSettingService;
    private $clientAdvService;
    private $clientCategoryService;
    private $clientProductService;
    private $clientPostService;
    private $clientCartService;
    private $setting;

    public function __construct(SettingService $clientSettingService,
                                AdvertisementService $clientAdvService,
                                ClientCategoryService $clientCategoryService,
                                ClientProductService $clientProductService,
                                ClientPostService $clientPostService,
                                ClientCartService $clientCartService
    )
    {
        $this->clientSettingService = $clientSettingService;
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
        $this->clientProductService = $clientProductService;
        $this->clientPostService = $clientPostService;
        $this->clientCartService = $clientCartService;

        $this->setting = $this->clientSettingService->findFirst();
        View::share('data_common', ['logo' => $this->clientAdvService->findByLogo(), 'setting' => $this->setting, 'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1]), 'page_user' => '1']);
    }

    /**
     * Cart list
     * @method GET
     */
    public function index()
    {
        try {
            $data['common'] = Helpers::metaHead((object)["title_seo" => "Giỏ hàng"]);
            $data['list'] = !empty($_SESSION['shopping_cart']) ? $_SESSION['shopping_cart'] : [];
            return view('clients::carts.index', ['data' => $data]);
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    /**
     * Add cart
     * @method GET
     */
    public function create($id)
    {
        try {
            $detail = $this->clientProductService->findById($id);
            if (empty($detail->id)) abort(404);
            if ($this->clientCartService->addCart($detail)) {
                return redirect(route('client.card.index'));
            } else {
                $errors = new MessageBag(['accountNotFound' => __('clients::layer.card.add.error')]);
                return back()->withInput([])->withErrors($errors);
            }
        } catch (\Exception $e) {
            if (empty($e->getMessage())) abort(404); else abort('500');
        }
    }

    /**
     * Page Register
     * @method POST
     */
    public function store(CreateRequest $request)
    {
        try {
            if($this->clientCartService->store($request->all())){
                session()->flash('success', __('clients::layer.user.payment.success'));
                return redirect(route('client.card.index'));
            }else{
                $errors = new MessageBag(['accountNotFound' => __('clients::layer.user.payment.error')]);
                return back()->withInput($request->all())->withErrors($errors);
            }
        } catch (\Exception $e) {
            $errors = new MessageBag(['accountNotFound' => $e->getMessage()]);
            return back()->withInput([])->withErrors($errors);
        }
    }

    /**
     * Update cart
     * @method POST
     */
    public function update($id)
    {
        try {
            if ($this->clientCartService->update($id)) {
                session()->flash('success', __('clients::layer.notify.success'));
                return redirect(route('client.card.index'));
            } else {
                $errors = new MessageBag(['accountNotFound' => __('clients::layer.notify.fail')]);
                return back()->withInput([])->withErrors($errors);
            }
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Destroy cart
     * @method GET
     */
    public function destroy($id)
    {
        try {
            if ($this->clientCartService->destroy($id)) {
                session()->flash('success', __('clients::layer.notify.success'));
                return redirect(route('client.card.index'));
            } else {
                $errors = new MessageBag(['accountNotFound' => __('clients::layer.notify.fail')]);
                return back()->withInput([])->withErrors($errors);
            }
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
