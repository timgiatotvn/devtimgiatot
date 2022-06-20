<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
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
        if (isset($_data['_token'])) unset($_data['_token']);
        unset($_data['proengsoft_jsvalidation']);
        $db = array_merge($_data, [
            'description' => !empty($_data['description']) ? $_data['description'] : '',
            //'slug' => !empty($_data['title']) ? Str::slug($_data['title'], '-') : '',
            'slug' => !empty($_data['slug']) ? $_data['slug'] : (!empty($_data['title']) ? Str::slug($_data['title'], '-') : ''),
            'admin_id' => Auth::guard(Helpers::renderGuard())->user()->id,
            'category_multi' => !empty($_data['category_multi']) ? '|' . implode('|', $_data['category_multi']) . '|' : '',
            'type' => $this::TYPE[1],
            'choose_1' => 0,
            'choose_2' => 0,
            'choose_3' => 0,
            'choose_4' => 0,
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s")
        ]);

        return $this->productRepository->create($db);
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
