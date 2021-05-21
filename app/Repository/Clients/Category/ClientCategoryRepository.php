<?php

namespace App\Repository\Clients\Category;

use Illuminate\Support\Facades\DB;

class ClientCategoryRepository implements ClientCategoryRepositoryInterface
{
    const TABLE_NAME = 'categories';

    public function findById($_id)
    {
        return DB::table(self::TABLE_NAME)->where('id', $_id)->first();
    }

    public function findBySlug($_slug)
    {
        return DB::table(self::TABLE_NAME)->where('slug', $_slug)->first();
    }

    public function getMenu()
    {
        return DB::table(self::TABLE_NAME)->orderBy('id', 'DESC')->first();
    }

    public function getListMenu($_data)
    {
        $type = !empty($_data['type']) ? $_data['type'] : '';
        return DB::table(self::TABLE_NAME)
            ->select('id', 'title', 'parent_id', 'slug', 'type', 'url')
            ->when($type, function ($query, $type) {
                return $query->whereIn('type', $type);
            })
            ->where('status', 1)
            ->orderBy('sort', 'ASC')
            ->get();
    }


}