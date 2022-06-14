<?php

namespace App\Repository\Admins\Article;

use App\Helpers\Helpers;
use App\Model\Article;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements ArticleRepositoryInterface
{
    const TABLE_NAME = 'articles';
    private $model;

    public function __construct()
    {
        $this->model = new Article();
    }

    public function getList($_data)
    {
        $keyword = !empty($_data['keyword']) ? $_data['keyword'] : '';
        $parent_id = !empty($_data['parent_id']) ? $_data['parent_id'] : [];
        $type = !empty($_data['type']) ? $_data['type'] : '';
        return $this->model->with('crawlerCategory')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->where('type', $type)
            ->orderBy('id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function findByKeyword($_data)
    {
        return $this->model->select("id", "name", "price", "crawler_category_id", "href", "thumbnail")->where('name', 'LIKE', '%' . $_data["keyword"] . '%')->get();
    }
}