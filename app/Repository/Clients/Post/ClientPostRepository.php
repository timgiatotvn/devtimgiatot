<?php

namespace App\Repository\Clients\Post;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
use App\Model\Category;

class ClientPostRepository implements ClientPostRepositoryInterface
{
    const TABLE_NAME = 'posts';

    public function getListByCategory($_data)
    {
        return DB::table(self::TABLE_NAME)
//            ->select('products.*', 'categories.title as category_title')
//            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('category_id', $_data['category_id'])
            ->where('choose_1', 1)
            ->where('type', $_data['type'])
            ->orderBy('sort', 'DESC')
            ->paginate($_data['limit']);
    }

}