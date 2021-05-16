<?php

namespace Modules\Clients\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Model\Category;
use App\Model\Post;
use App\Helpers\Helpers;

class CategoriesController extends Controller
{

    public function index($slug)
    {
        try {
            $cate = Category::fildBySlug($slug);
            $cate_id = $cate->id;
            $cate_sub = Category::listSubCategory(4,$cate_id);
            $data['common'] = Helpers::metaHead($cate);
            $data['common']['thumbnail'] = $cate->thumb_url;

            $listNews = Post::getListPost(15,$cate_id,'DESC');

            return view('clients::categories.index',[
                'cate'=>$cate,
                'cate_sub'=>$cate_sub,
                'data' => $data,
                'listNews' => $listNews,
            ]);
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
