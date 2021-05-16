<?php

namespace Modules\Clients\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Model\Category;
use App\Model\Post;
use App\Model\Setting;

class HomeController extends Controller
{
    /**
     * Page Home
     * @method GET
     */
    public function index()
    {
        try {
            $setting = Setting::getbyID(1);
            $data['common']['title_seo'] = $setting->title_seo;
            $data['common']['meta_des'] = $setting->meta_des;
            $data['common']['meta_key'] = $setting->meta_key;
            $data['common']['thumbnail'] = $setting->logo_top;

            $cateHome = Category::listCate(3,'choose_1','desc');

            return view('clients::home.index',['data'=>$data,'cateHome'=>$cateHome]);
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
