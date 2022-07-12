<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Admins\CategoryService;
use App\Service\Admins\ProductService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Modules\Admins\Http\Requests\Product\CreateRequest;
use Modules\Admins\Http\Requests\Product\EditRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ConfigController extends Controller
{

    private $categoryService;
    private $productService;
    private $type;

    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->type = [$this->categoryService::TYPE[1]];
    }

    public function configCateHome(Request $request)
    {
        try {
            $data['list_cate'] = DB::table('categories')
                ->where('parent_id', 2)
                ->get();
            $data['list_cate_show'] = DB::table('categories_show')
                ->where('status', 1)
                ->get();
//            dd($data['list_cate_show']);
            return view('admins::config.homeCate', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }

    public function setValue(Request $request)
    {
        try {
            $_params = $request->all();
            foreach ($_params['cate_show'] as $index => $value) {
                DB::table('categories_show')->where('id', $_params['cate_id'][$index])->update(['cate_id' => $value]);
            }
            session()->flash('success', __('Thao tác thành công'));
            return redirect()->route('admin.config.home-cate');
        } catch (\Exception $e) {
            abort('500');
        }
    }

}
