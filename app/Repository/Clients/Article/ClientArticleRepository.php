<?php

namespace App\Repository\Clients\Article;

use App\Helpers\Helpers;
use App\Model\Article;
use Illuminate\Support\Facades\DB;

class ClientArticleRepository implements ClientArticleRepositoryInterface
{
    const TABLE_NAME = 'articles';
    private $model;

    public function __construct()
    {
        $this->model = new Article();
    }

    public function getList($_data)
    {
        return $this->model
            ->whereIn('id', $_data["list_id"])
            ->orderBy('price', 'ASC')
            ->paginate($_data['limit']);
    }

}