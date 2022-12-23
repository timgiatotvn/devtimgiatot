<?php

namespace Modules\Admins\Http\Controllers;

use App\Model\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Model\Product;
use App\Model\Category;

class SellerController extends Controller
{
    public function listProduct(Request $request)
    {
        $data['categories'] = Category::where('type', 'product')->get();
        $inputs = $request->all();
        $products = Product::query();
        $products->whereNotNull('shop_id')->latest();
        
        if (isset($inputs['keyword'])) {
            $products->where('title', 'like', '%' . $inputs['keyword'] . '%');
        }
        if (isset($inputs['category_id']) && $inputs['category_id'] != -1) {
            $products->where('category_id', $inputs['category_id']);
        }
        if (isset($inputs['status']) && $inputs['status'] != -1) {
            $products->where('status', $inputs['status']);
        }
        $data['products'] = $products->with(['user', 'category'])->paginate(20);
        $data['inputs'] = $inputs;
        $data['total'] = $data['products']->total();

        return view('admins::sellers.product', $data);
    }

    public function changeStatusProduct(Request $request)
    {
        Product::whereId($request->id)->update(['status' => $request->status]);

        return back()->with('success', 'Cập nhật trạng thái thành công');
    }
}