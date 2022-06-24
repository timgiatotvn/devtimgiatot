<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\Helpers;
use App\Model\Post;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param $id
     * @param Request $request
     * @return Renderable
     */
    public function index($id, Request $request)
    {
        $perPage = $request->get('per_page') ? $request->get('per_page') : 10;

        $data = Post::getPostByCategoryId($id)->paginate($perPage);
        $posts = Post::formatData($data);

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $posts
        ]);
    }

    public function show($id)
    {
        $post = Post::with(['category' => function($query) {
            return $query->select('id', 'title');
        }])->where('id', $id)
            ->where('status', 1)
            ->select('id', 'title', 'slug', 'description', 'content', 'thumbnail', 'link_detail', 'category_id')
            ->first();

        $post->thumbnail = Helpers::getUrlFile($post->thumbnail);

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $post
        ]);
    }
}
