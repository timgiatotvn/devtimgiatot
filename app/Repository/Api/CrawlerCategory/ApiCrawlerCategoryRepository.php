<?php

namespace App\Repository\Api\CrawlerCategory;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class ApiCrawlerCategoryRepository implements ApiCrawlerCategoryRepositoryInterface
{
    const TABLE_NAME = 'crawler_categories';

    public function getList()
    {
        return DB::table(self::TABLE_NAME)
            ->where("status", 1)
            ->where("checked", 1)
            ->where("type_crawler", "ajax")
            ->orderBy('id', 'ASC')
            ->get();
    }

}