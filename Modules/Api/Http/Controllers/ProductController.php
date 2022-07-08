<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\Helpers;
use App\Model\Article;
use App\Model\Product;
use App\Service\Clients\ClientArticleService;
use App\Service\Clients\ClientProductService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    private $clientProductService;
    private $clientArticleService;

    public function __construct(ClientProductService $clientProductService,
                                ClientArticleService $clientArticleService)
    {
        $this->clientProductService = $clientProductService;
        $this->clientArticleService = $clientArticleService;
    }

    public function getProductByCategory($id, Request $request)
    {
        $perPage = $request->get('per_page') ? $request->get('per_page') : 10;
        $data = Product::with(['category' => function($query) {
                return $query->select('id', 'title');
            }])->where('category_id', $id)
                ->where('status', 1)
                ->select('id', 'category_id', 'title', 'slug', 'price', 'count_suggest', 'thumbnail_cr', 'thumbnail')
                ->orderBy('id', 'DESC')
                ->paginate($perPage);

        $products = $this->formatProduct($data);

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $products
        ]);


    }

    public function show($id)
    {
        $product = Product::where('id', $id)
            ->select('id', 'category_id', 'title', 'slug', 'description', 'content',
                'price', 'count_suggest', 'thumbnail_cr', 'thumbnail', 'website_map')
            ->first();

        $ws = json_decode($product->website_map, true);
        if(!empty($ws[0]["crawler_website"]["id"]) && !empty($ws[0]["article"]["id"])) {
            $product->website_map = $ws[0]["crawler_website"]["title"];
            $product->link_website = $ws[0]["article"]["href"];
        }

        $product->thumbnail = Helpers::renderThumbProduct((!empty($product->thumbnail_cr) ? $product->thumbnail_cr : $product->thumbnail), 'product_detail');

        $product->price = Helpers::formatPrice($product->price);

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $product
        ]);
    }

    public function comparePrice($id)
    {
        $product = Product::where('id', $id)->select('id', 'keyword_suggest_map_crawler')->first();
        $compares = [];
        if ($product) {
            $listId = explode('|', $product->keyword_suggest_map_crawler);

            $data = Article::with(['crawlerCategory' => function($query) {
                return $query->select('id', 'crawler_website_id');
                }])
                ->whereIn('id', $listId)
                ->select('id', 'crawler_category_id', 'name', 'price', 'href')
                ->orderBy('price', 'ASC')
                ->paginate(15);
            $compares = $this->formatCompareProduct($data);
        }

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $compares
        ]);

    }

    public function formatCompareProduct($data)
    {
        foreach ($data as $item) {
            $item->logo_website = Helpers::getUrlFile(!empty($item->crawlerCategory) ? $item->crawlerCategory->crawlerWebsite->thumbnail : null);
            $item->price = Helpers::formatPrice($item->price);
            $item->crawler_category = "ok";
        }

        return $data;
    }

    public function formatProduct($data)
    {
        foreach ($data as $item)
        {

            $item->thumbnail = Helpers::renderThumbProduct((!empty($item->thumbnail_cr) ? $item->thumbnail_cr : $item->thumbnail), 'list_product');
            $item->price = Helpers::formatPrice($item->price);
        }

        return $data;
    }

    public function search(Request $request)
    {
        $keyword = $request->get('keyword');
        $perPage = $request->get('per_page') ? $request->get('per_page') : 10;

        $data = Product::with(['category' => function($query) {
            return $query->select('id', 'title');
            }])
            ->where('title', 'LIKE', '%' . $keyword . '%')
            ->where('status', 1)
            ->select('id', 'category_id', 'title', 'slug', 'price', 'count_suggest', 'thumbnail')
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

        $products = $this->formatProduct($data);

        return response()->json([
            'status' => 200,
            'message' => 'success',

            'data' => [
                'keyword' => $keyword,
                'products' => $products
            ]
        ]);
    }

    public function store(Request $request)
    {
        $data = [
          'category_id' => $request->get('category_id'),
          'title' => $request->get('title'),
          'price' => $request->get('price'),
          'contact' => $request->get('contact'),
          'description' => $request->get('description'),
          'referral_code' => $request->get('referral_code'),
        ];

        $product = new Product();
        $product->fill($data);
        $product->save();
    }
}
