<?php

namespace Modules\Clients\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Product;
use App\Model\CartItem;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Service\Clients\AdvertisementService;
use App\Service\Clients\ClientCategoryService;
use App\Service\Clients\SettingService;

class SellerController extends Controller
{
    private $clientAdvService;

    private $setting;

    private $clientSettingService;

    private $clientCategoryService;

    public function __construct(
        AdvertisementService $clientAdvService,
        SettingService $clientSettingService,
        ClientCategoryService $clientCategoryService
    )
    {
        $this->clientCategoryService = $clientCategoryService;
        $this->clientSettingService = $clientSettingService;
        $this->setting = $this->clientSettingService->findFirst();
        $this->clientAdvService = $clientAdvService;
        View::share('data_common', ['logo' => $this->clientAdvService->findByLogo(), 'setting' => $this->setting, 'category_list' => $this->clientCategoryService->getListMenu(['multi' => 1]), 'page_user' => '1']);
    }

    public function index()
    {
        if (auth('users')->user()->shop_name == '') {
            return view('clients::sellers.register');
        } else {
            return redirect()->route('seller.product.list');
        }
    }

    public function formAddProduct()
    {
        if (!auth('users')->user()->status_sale) {
            return back()->with('error', 'Shop của bạn chưa được duyệt');
        }
        $categories = Category::where('type', 'product')->get();

        return view('clients::sellers.pages.products.add', ['categories' => $categories]);
    }

    public function formEditProduct($id)
    {
        $data['categories'] = Category::where('type', 'product')->get();
        $data['product'] = Product::find($id);

        return view('clients::sellers.pages.products.edit', $data);
    }

    public function updateNameShop(Request $request)
    {
        try {
            auth('users')->user()->update(['shop_name' => $request->shop_name]);

            return back();
        } catch (\Throwable $th) {
            return back()->with('error', 'Vui lòng thử lại');
        }
    }

    public function listProduct()
    {
        $data['categories'] = Category::where('type', 'product')->get();
        $products = Product::query();
        $products->latest()->where('shop_id', auth('users')->user()->id);
        
        if (isset($request->key_search) && $request->key_search != '') {
            $products->where('title', 'like', '%' . $request->key_search);
        }
        if (isset($request->category_id) && $request->category_id != -1) {
            $products->where('category_id', $request->category_id);
        }
        $data['products'] = $products->paginate(20);

        return view('clients::sellers.pages.products.list', $data);
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        $product->delete();

        return back()->with('success', 'Xóa thành công');
    }

    public function updateProduct(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|min:10',
            'category_id' => 'required',
            'price_root' => 'required',
            'price' => 'required',
            'description' => 'required|min:20',
            'content' => 'required|min:100',
            'thumbnail' => 'nullable|mimes:jpg,png',
            'images' => 'nullable|array',
            'images.*' => 'nullable|mimes:jpg,png'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $product = Product::find($id);
        $inputs = $request->except('_token', 'images', 'thumbnail');
        
        if (!empty($request->thumbnail)) {
            $thumbnail = $request->thumbnail;
            \Storage::disk('s3')->put('photos/' . $thumbnail->getClientOriginalName(), file_get_contents($thumbnail));
            $s3 = \Storage::disk('s3')->getAdapter()->getClient();
            $inputs['thumbnail'] = $s3->getObjectUrl(env('AWS_BUCKET'), 'photos/' . $thumbnail->getClientOriginalName());
        } else {
            $inputs['thumbnail'] = $product->thumbnail;
        }
        if (!empty($request->images) && count($request->images) > 0) {
            $links = [];
            foreach ($request->images as $imageItem) {
                \Storage::disk('s3')->put('photos/' . $imageItem->getClientOriginalName(), file_get_contents($imageItem));
                $s3 = \Storage::disk('s3')->getAdapter()->getClient();
                $links[] = $s3->getObjectUrl(env('AWS_BUCKET'), 'photos/' . $imageItem->getClientOriginalName());
            }
            $inputs['images'] = json_encode($links);
        } else {
            $inputs['images'] = $product->images;
        }
        $product->update($inputs);

        return back()->with('success', 'Sửa thành công');
    }

    public function storeProduct(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|min:10',
            'category_id' => 'required',
            'price_root' => 'required',
            'price' => 'required',
            'description' => 'required|min:20',
            'content' => 'required|min:100',
            'thumbnail' => 'required|mimes:png,jpg',
            'images' => 'nullable|array',
            'images.*' => 'nullable|mimes:png,jpg,PNG'
        ]);
        if ($validator->fails()) {
           // dd($validator);
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $inputs = $request->except('_token', 'images', 'thumbnail');
        $inputs['slug'] = str_slug($inputs['title']);
        $inputs['type'] = 'product';
        $inputs['status'] = 0;
        $inputs['shop_id'] = auth('users')->user()->id;
        $thumbnail = $request->thumbnail;
        \Storage::disk('s3')->put('photos/' . $thumbnail->getClientOriginalName(), file_get_contents($thumbnail));
        $s3 = \Storage::disk('s3')->getAdapter()->getClient();
        $inputs['thumbnail'] = $s3->getObjectUrl(env('AWS_BUCKET'), 'photos/' . $thumbnail->getClientOriginalName());

        if (!empty($request->images) && count($request->images) > 0) {
            $links = [];
            foreach ($request->images as $imageItem) {
                \Storage::disk('s3')->put('photos/' . $imageItem->getClientOriginalName(), file_get_contents($imageItem));
                $s3 = \Storage::disk('s3')->getAdapter()->getClient();
                $links[] = $s3->getObjectUrl(env('AWS_BUCKET'), 'photos/' . $imageItem->getClientOriginalName());
            }
            $inputs['images'] = json_encode($links);
        } else {
            $inputs['images'] = json_encode([]);
        }        
        Product::create($inputs);

        return back()->with('success', 'Thêm thành công');
    }

    public function listOrder(Request $request)
    {
        $data['orders'] = CartItem::where('shop_id', auth('users')->user()->id)
                                  ->with(['cart', 'productDetail'])
                                  ->paginate(20);

        return view('clients::sellers.pages.orders.list', $data);
    }
}