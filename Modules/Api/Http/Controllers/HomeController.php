<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\Helpers;
use App\Model\Advertisement;
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
        if (empty($token)) {

            return response()->json([
                'status' => 500,
                'message' => 'token không được để trống.',
            ]);
        }

        $data = $request->all();
        $device = new Device();
        $device->fill($data);
        $device->save();

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $device
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


        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => [
                'sliders' => $sliders,
                'categories' => $categories,
                'shopping' => $shopping,
                'promotions' => $promotions,
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
}
