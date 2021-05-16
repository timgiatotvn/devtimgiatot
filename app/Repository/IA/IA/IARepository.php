<?php

namespace App\Repository\IA\IA;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class IARepository implements IARepositoryInterface
{
    const TABLE_POSTS = 'posts';
    const TABLE_CATEGORY = 'categories';

    public function getList($_data)
    {
        return DB::table(self::TABLE_POSTS)
            ->select(self::TABLE_POSTS . '.*', self::TABLE_CATEGORY . '.title as cate_title')
            ->leftJoin(self::TABLE_CATEGORY, self::TABLE_POSTS . '.category_id', self::TABLE_CATEGORY . '.id')
            ->limit($_data['limit'])
            ->orderBy('id', 'DESC')
            ->get();
    }

}