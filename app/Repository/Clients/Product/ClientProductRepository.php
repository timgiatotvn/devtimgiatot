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

    public function getListAll($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->where('type', $_data['type'])
            ->orderBy('id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListByCate($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->whereIn('category_id', $_data['cate_multi'])
            ->whereIn('type', $_data['type'])
            ->orderBy('id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListByCateSearch($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->where('title', 'LIKE', '%' . $_data['keyword'] . '%')
            ->whereIn('type', $_data['type'])
            ->orderBy('id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListHome($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->select('products.*', 'categories.title as category_title')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->whereIn('products.type', $_data['type'])
            ->orderBy('products.id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListRelated($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->where('category_id', $_data['category_id'])
            ->where('type', $_data['type'])
            ->orderBy('sort', 'DESC')
            ->paginate($_data['limit']);
    }

}