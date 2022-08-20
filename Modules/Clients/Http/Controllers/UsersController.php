<?php

namespace Modules\Clients\Http\Controllers;

use App\Helpers\Helpers;
use App\Model\Notification;
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
use DB;

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

    public function viewNotification()
    {
        $data['list'] = Notification::with('deviceReadNotification')
                                    ->where('is_delete', 0)
                                    ->where('user_id', auth('users')->user()->id)
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);
        return view('clients::notifications.index', ['data' => $data]);
    }

    public function createNotification()
    {
        return view('clients::notifications.create');
    }

    public function editNoti($id)
    {
        $noti = Notification::whereId($id)->where('user_id', auth('users')->user()->id)->first();

        if (empty($noti)) {
            return redirect()->route('client.user.notification')->with('error', 'Không tồn tại');
        }

        return view('clients::notifications.edit', ['noti' => $noti]); 
    }

    public function deleteNoti($id)
    {
        $noti = Notification::whereId($id)->where('user_id', auth('users')->user()->id)->first();

        if (empty($noti)) {
            return redirect()->route('client.user.notification')->with('error', 'Không tồn tại');
        }
        $noti->update(['is_delete' => 0]);

        return redirect()->route('client.user.notification')->with('success', 'Xóa thành công');
    }

    public function updateNoti(Request $request, $id)
    {
        $notification = Notification::find($id);
        $notification->title = $request->get('title');
        // $notification->thumbnail = $request->get('thumbnail');
        $notification->description = $request->get('description');
        $notification->content = $request->get('content');
        if ($notification->status == 2 && $request->get('status') != 2) {
            $notification->publish_at = NULL;
        } else {
            $notification->publish_at = $request->get('publish_at') . ' ' . $request->get('hour');
        }
        $notification->status = $request->get('status');
        $notification->save();

        return redirect()->route('client.user.notification')->with('success', 'Sửa thành công');
    }

    public function storeNotification(Request $request)
    {
        $user = auth('users')->user();
        $checkLimitPushNoti = Notification::where('user_id', $user->id)
                                          ->whereDate('created_at', date('Y-m-d'))
                                          ->count();
        
        if ($checkLimitPushNoti >= $user->push_number) {
            return back()->with('error', 'Bạn đã đạt giới hạn gửi thông báo hôm nay. Vui lòng liên hệ bộ phận CSKH theo Hotline: 0912.399.322 để được tăng giới hạn đăng thông báo! Xin cảm ơn!');
        }
        DB::beginTransaction();
        $notification = new Notification();
        $notification->title = $request->get('title');
        // $notification->thumbnail = $request->get('thumbnail');
        $notification->description = $request->get('description');
        $notification->content = $request->get('content');
        $notification->status = $request->get('status');
        if ($request->get('publish_at')) {
            $notification->publish_at = $request->get('publish_at') . ' ' . $request->get('hour');
        }
        $notification->user_id = Auth::guard(Helpers::renderGuard(1))->user()->id;
        $notification->save();

        if ($notification->status == 1) {
            $result = Notification::sendNotification($notification);
        }
        DB::commit();
        if (isset($result) && $result['failure'] == 1) {
            session()->flash('error', __('Không thể gửi thông báo tới app vui lòng kiểm tra lại'));
        }

        return redirect()->route('client.user.notification')->with('success', 'Thêm thành công');
    }
}
