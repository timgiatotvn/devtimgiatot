<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use App\Model\Article;
use App\Repository\Admins\Product\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductService
{
    private $categoryService;
    private $productRepository;
    const TYPE = ['product', 'crawler'];

    public function __construct(CategoryService $categoryService, ProductRepositoryInterface $productRepository)
    {
        $this->categoryService = $categoryService;
        $this->productRepository = $productRepository;
    }

    public function getList($_data = [])
    {
        $_data['keyword'] = request()->has('keyword') ? request()->get('keyword') : '';
        $_data['category_id'] = request()->has('category_id') ? $this->categoryService->multiCate(request()->get('category_id')) : '';
        return $this->productRepository->getList($_data);
    }

    public function listAllCrawler(){
        return $this->productRepository->listAllCrawler();
    }

    public function findById($_id)
    {
        return $this->productRepository->findById($_id);
    }

    public function updateStatus($_id, $_status)
    {
        $detail = self::findById($_id);
        return $this->productRepository->updateStatus($_id, $_status, (($detail->$_status) ? 0 : 1));
    }

    public function destroyAll($_data)
    {
        return $this->productRepository->destroyAll($_data);
    }

    public function destroy($_id)
    {
        return $this->productRepository->destroy($_id);
    }

    public function create($_data)
    {
        try {
            if (isset($_data['_token'])) unset($_data['_token']);
            unset($_data['proengsoft_jsvalidation']);
            $result = $this->mapProductsToArticle($_data['keyword_suggest']);
            $db = array_merge($_data, [
                'description' => !empty($_data['description']) ? $_data['description'] : '',
                //'slug' => !empty($_data['title']) ? Str::slug($_data['title'], '-') : '',
                'slug' => !empty($_data['slug']) ? $_data['slug'] : (!empty($_data['title']) ? Str::slug($_data['title'], '-') : ''),
                'admin_id' => Auth::guard(Helpers::renderGuard())->user()->id,
                'category_multi' => !empty($_data['category_multi']) ? '|' . implode('|', $_data['category_multi']) . '|' : '',
                'type' => $this::TYPE[1],
                'keyword_suggest_map_crawler' => $result['data'],
                'website_map' => $result['website_map'],
                'price' => $result['price_min'],
                'price_root' => $result['price_min'],
                'count_suggest' => $result['total'],
                'thumbnail_cr' => $result['thumbnail'],
                'choose_1' => 0,
                'choose_2' => 0,
                'choose_3' => 0,
                'choose_4' => 0,
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ]);

            return $this->productRepository->create($db);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        
    }

    public function mapProductsToArticle($keyword_suggest)
    {
        $list_ids = [];
        if ($keyword_suggest != '') {
            foreach (explode(',', $keyword_suggest) as $keywordItem) {
                $articles = Article::where('name', 'like', '%' . trim($keywordItem) . '%')
                                   ->pluck('id')
                                   ->toArray();
                
                if (count($articles) > 0) {
                    $list_ids = array_merge($articles, $list_ids);
                }
            }
        }
        $result = array_unique($list_ids);
        $get_product_min = $this->get_product_min($result);

        return [
            'total' => count($result),
            'data' => count($result) > 0 ? "|" . implode("|", $result) . "|" : "",
            'website_map' => json_encode($get_product_min['website_map']),
            'price_min' => $get_product_min['price'],
            'thumbnail' => $get_product_min['website_map'][0]['article']['thumbnail']
        ];
    }

    public function get_product_min($article_ids)
    {
        if (count($article_ids) > 0) {
            try {
                $article = Article::select("id", "name", "price", "crawler_category_id", "href", "thumbnail")
                                ->whereIn('id', $article_ids)->oldest('price')
                                ->first();

                return [
                    'price' => $article->price,
                    'website_map' => [
                        [
                            'crawler_website' => $article->crawlerCategory->crawlerWebsite->toArray(),
                            'article' => [
                                'id' => $article->id,
                                'name' => $article->name,
                                'price' => $article->price,
                                'crawler_category_id' => $article->crawler_category_id,
                                'href' => $article->href,
                                'thumbnail' => $article->thumbnail
                            ]
                        ]
                    ]
                ];
            } catch (\Throwable $th) {
                dd($article->id, $th->getMessage());
            }
            
        }
        
        return [
            'price' => '',
            'website_map' => ''
        ];
    }

    public function update($_data, $_id)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        if (isset($_data['page'])) unset($_data['page']);
        unset($_data['proengsoft_jsvalidation']);

        $db = array_merge($_data, [
            //'description' => !empty($_data['description']) ? substr(strip_tags($_data['description']), 0, 1000) : '',
            'description' => !empty($_data['description']) ? $_data['description'] : '',
            //'slug' => !empty($_data['title']) ? Str::slug($_data['title'], '-') : '',
            'category_multi' => !empty($_data['category_multi']) ? '|' . implode('|', $_data['category_multi']) . '|' : '',
            'updated_at' => date("Y/m/d H:i:s")
        ]);
        return $this->productRepository->update($db, $_id);
    }

    public function updateCrawler($_data, $_id)
    {
        return $this->productRepository->updateCrawler($_data, $_id);
    }

}
