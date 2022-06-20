<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use App\Model\Product;
use App\Repository\Admins\Article\ArticleRepositoryInterface;
use Illuminate\Support\Str;

class ArticleService
{
    private $repository;
    private $productService;
    private $crawlerCategoryService;
    const TYPE = ['crawler'];

    public function __construct(ArticleRepositoryInterface $repository, ProductService $productService, CrawlerCategoryService $crawlerCategoryService)
    {
        $this->repository = $repository;
        $this->productService = $productService;
        $this->crawlerCategoryService = $crawlerCategoryService;
    }

    public function getList($_data = [])
    {
        $_data['keyword'] = request()->has('keyword') ? request()->get('keyword') : '';
        $_data['parent_id'] = !empty(request()->get('parent_id')) ? request()->get('parent_id') : 'null';
        $_data['type'] = self::TYPE[0];
        return $this->repository->getList($_data);
    }

    public function listAll()
    {

    }

    public function mapProductsToArticle()
    {
        $allArticle = $this->productService->listAllCrawler();
        foreach ($allArticle as $row) {
            if (!empty($row->keyword_suggest)) {
                $tmp = explode(',', $row->keyword_suggest);
                $keyword = [];
                foreach ($tmp as $r) {
                    $keyword[] = trim($r);
                }
                $this->findArticle($row->id, $keyword);
            }
        }
    }

    public function findArticle($product_id, $keyword)
    {
        $data = [];
        $data_website_map = [];
        $article_price_min = [];
        $price_min = "";
        foreach ($keyword as $row) {
            $find = $this->repository->findByKeyword(["keyword" => $row]);
            foreach ($find as $r) {
                if (empty($price_min)) {
                    $price_min = $r->price;
                    $article_price_min = $r->toArray();
                }
                if ($r->price < $price_min) {
                    $price_min = $r->price;
                    $article_price_min = $r->toArray();
                }
                $data[$r->id] = $r->id;

                //website map
                if (!empty($r->crawlerCategory->crawlerWebsite->id)) {
                    $ws = $r->crawlerCategory->crawlerWebsite;
                    $data_website_map[$ws->id] = [
                        "crawler_website" => $ws->toArray(),
                        "article" => $article_price_min
                    ];
                }
            }
        }

        //order price website
        $map_website = [];
        for ($i = 0; $i < count($data_website_map); $i++) {
            $key_min = "";
            $key_price_min = "";
            foreach ($data_website_map as $k => $row) {
                if (empty($key_price_min)) {
                    $key_min = $k;
                    $key_price_min = $row["article"]["price"];
                }
                if ($row["article"]["price"] < $key_price_min) {
                    $key_min = $k;
                    $key_price_min = $row["article"]["price"];
                }
            }
            $map_website[] = $data_website_map[$key_min];
            unset($data_website_map[$key_min]);
        }

        //download img
        if (!empty($map_website[0]["article"])) {
            $value = $map_website[0]["article"];
            $img = @file_get_contents($value["thumbnail"]);
            $file = "/storage/photos/down/" . Str::slug($value['name'], '-') . "-" . time() . ".jpeg";
            @file_put_contents(public_path($file), $img);

            Product::where('id', $product_id)->update(["thumbnail_cr" => $file]);
        }


        //update product so sanh
        $str = (count($data) > 0) ? "|" . implode("|", $data) . "|" : "";
        $this->productService->updateCrawler(["keyword_suggest_map_crawler" => $str, "price" => $price_min, "count_suggest" => count($data), "website_map" => @json_encode($map_website)], $product_id);

    }

}
