<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Admins\AccountService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Modules\Admins\Http\Requests\Account\CreateRequest;
use Modules\Admins\Http\Requests\Account\EditRequest;

use DB,DateTime;

class ApiController extends Controller
{
    protected $parent_id = 3;

    public function create(Request $request)
    {

    }

    public function store(Request $request)
    {
        $data['title']       = $request->title??'';
        $data['slug']        = $request->title?str_slug($request->title):'';
        $data['admin_id']    = $request->admin_id?? 1;
        if (!empty($request->category_id)) {
            foreach ($request->category_id as $key => $value) {
                $data['category_id'] = $value;
            }
        } else {
            $data['category_id'] = 0;
        }
        $data['content']     = $request->content??'';
        $data['title_seo']   = $request->seo_title??'';
        $data['description']   = $request->description??'';
        $data['meta_des']    = $request->seo_metadesc??'';
        $data['meta_key']    = $request->seo_focus??'';
        $data['author']      = $request->author_name??'';
        $data['type']     = 'new';
        $data['created_at']  = new DateTime();
        $data['updated_at']  = new DateTime();
        $data['thumbnail']   = $request->image;
        DB::table('posts')->insert($data);
    }

    public function list(Request $request)
    {
        $categories = DB::table('categories')->where('parent_id', '=' , $this->parent_id)->get();
        return response($categories);
    }

    public function getListPost()
    {
        $listPost = DB::table('posts')
                    ->select('posts.id as ID','posts.author','posts.title as post_title','posts.slug as post_name','posts.category_id','posts.created_at','posts.type','categories.title as cate_name')
                    ->join('categories','categories.id','=','posts.category_id')->where('categories.parent_id',$this->parent_id)
                    ->orderBy('posts.id','DESC')
                    ->paginate(10);
        return response($listPost);
    }
}
