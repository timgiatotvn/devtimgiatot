<?php

namespace Modules\Clients\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Model\Post;
use App\Helpers\Helpers;

class PostsController extends Controller
{
    /**
     * Page show
     * @method GET
     */
    public function show($slug)
    {

        try {
            $detail = Post::fildBySlug($slug);
            $id = $detail->id;
            $cate_id = $detail->category_id;
            $listRelated = Post::postRelated($id,$cate_id,10);

            $data['common'] = Helpers::metaHead($detail);
            $data['common']['thumbnail'] = $detail->thumbnail;


            return view('clients::posts.show',[
                'detail'=>$detail,
                'listRelated'=>$listRelated,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
