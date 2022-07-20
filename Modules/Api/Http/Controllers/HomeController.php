<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\Helpers;
use App\Model\Advertisement;
use App\Model\AppVersion;
use App\Model\Category;
use App\Model\Device;
use App\Model\Post;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    private $clientAdvService;
    private $clientCategoryService;

    public function __construct(AdvertisementService $clientAdvService, ClientCategoryService $clientCategoryService)
    {
        $this->clientAdvService = $clientAdvService;
        $this->clientCategoryService = $clientCategoryService;
    }

    public function setup(Request $request)
    {
        $token = $request->get('token');
        $lat = $request->get('lat');
        $long = $request->get('long');

        if (empty($token)) {

            return response()->json([
                'status' => 500,
                'message' => 'token không được để trống.',
            ]);
        }

        $data = $request->all();
        $device = Device::where('token', $token)->first();
        if (empty($device)) {
            $device = new Device();
        }
        $device->fill($data);
        $device->save();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $device
        ]);

    }

    public function setupAppVersion(Request $request)
    {
        $versionApp = $request->get('app_version');
        if (empty($versionApp)) {

            return response()->json([
                'status' => 500,
                'message' => 'app_version không được để trống.',
            ]);
        }

        $data = $request->all();
        $version = new AppVersion();
        $version->fill($data);
        $version->save();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $version
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        //$slider;
        $data = $this->clientAdvService->getListSlideShow();
        $sliders = Advertisement::formatData($data);
        $categories = Category::getCategoryByName('tìm giá tốt');
        $shopping = $this->formatLink($this->clientAdvService->getListLink());
        $categoryPromotion  = Category::where('title', 'LIKE', "Tin khuyến mãi")
            ->where('type', 'new')
            ->where('status', 1)->select('id', 'title')->first();
        $promotions = [];
        if ($categoryPromotion) {
            $data = Post::getPostByCategoryId($categoryPromotion->id)->take(6)->get();
            $promotions = Post::formatData($data);
        }
        $appVersion = AppVersion::query()->orderBy('created_at', 'DESC')->first();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => [
                'sliders' => $sliders,
                'categories' => $categories,
                'shopping' => $shopping,
                'promotions' => $promotions,
                'appVersion' => $appVersion
            ]
        ]);
    }

   public function formatLink($data)
   {
       foreach ($data as $item) {
           $item->thumbnail = Helpers::getUrlFile($item->thumbnail);
       }

       return $data;
   }

   public function category($id)
   {
       $categories = Category::getCategoryById($id);

       return response()->json([
           'status' => 200,
           'message' => 'success',
           'data' => $categories
       ]);

   }
}
