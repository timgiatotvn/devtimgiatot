<?php

namespace App\Repository\Clients\Product;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
use App\Model\Category;

class ClientProductRepository implements ClientProductRepositoryInterface
{
    const TABLE_NAME = 'products';

    public function findById($_id)
    {
        return DB::table(self::TABLE_NAME)
            ->select('products.*', 'categories.title as category_title', 'categories.slug as category_slug', 'categories.parent_id as category_parent_id')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $_id)
            ->first();
    }

    public function getList($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->select('products.*', 'categories.title as category_title')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.type', $_data['type'])
            ->orderBy('products.id', 'DESC')
            ->paginate($_data['limit']);
    }

}