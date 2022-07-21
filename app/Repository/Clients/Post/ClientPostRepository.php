<?php

namespace App\Repository\Clients\Post;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
use App\Model\Category;

class ClientPostRepository implements ClientPostRepositoryInterface
{
    const TABLE_NAME = 'posts';


    public function findById($_id)
    {
        return DB::table(self::TABLE_NAME)
            ->select('posts.*', 'categories.title as category_title', 'categories.slug as category_slug', 'categories.parent_id as category_parent_id')
            ->leftJoin('categories', 'posts.category_id', 'categories.id')
            ->where('posts.id', $_id)
            ->where('posts.status', 1)
            ->first();
    }

    public function findBySlug($_slug)
    {
        return DB::table(self::TABLE_NAME)
            ->select('posts.*', 'admins.name as author_name', 'categories.title as category_title', 'categories.slug as category_slug', 'categories.parent_id as category_parent_id')
            ->leftJoin('categories', 'posts.category_id', 'categories.id')
            ->leftJoin('admins', 'posts.admin_id', 'admins.id')
            ->where('posts.slug', $_slug)
            ->where('posts.status', 1)
            ->first();
    }

    public function getListByCategory($_data)
    {
        return DB::table(self::TABLE_NAME)
//            ->select('products.*', 'categories.title as category_title')
//            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->whereIn('category_id', $_data['category_id'])
            //->where('choose_1', 1)
            ->where('type', $_data['type'])
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListByCate($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->whereIn('category_id', $_data['cate_multi'])
            ->where('type', $_data['type'])
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate($_data['limit']);
    }

    public function getListRelated($_data)
    {
        return DB::table(self::TABLE_NAME)
            ->where('category_id', $_data['category_id'])
            ->where('id', '!=', $_data['id'])
            ->where('status', 1)
            ->where('type', $_data['type'])
            ->orderBy('sort', 'DESC')
            ->paginate($_data['limit']);
    }

}