<?php

namespace App\Repository\Api\Article;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiArticleRepository implements ApiArticleRepositoryInterface
{
    const TABLE_NAME = 'articles';
    const TABLE_NAME_CATE = 'crawler_categories';

    public function store($_data)
    {
        try {
            $check = DB::table(self::TABLE_NAME)->where("href", $_data["href"])->where("type", $_data["type"])->first();
            if (!empty($check->id)) {
                if (DB::table(self::TABLE_NAME)->where('id', $check->id)->update($_data)) {
                    if($_data["type"] == "demo") DB::table(self::TABLE_NAME_CATE)->where('id', $_data["crawler_category_id"])->update(["checked" => 1]);

                    Log::info("true update");
                    return true;
                } else {
                    Log::info("false update");
                    return false;
                }
            } else {
                if (DB::table(self::TABLE_NAME)->insert($_data)) {
                    if($_data["type"] == "demo") DB::table(self::TABLE_NAME_CATE)->where('id', $_data["crawler_category_id"])->update(["checked" => 1]);

                    Log::info("true insert");
                    return true;
                } else {
                    Log::info("false insert");
                    return false;
                }
            }
        } catch (\Exception $e) {
            Log::info("false " . $e->getMessage());
            return false;
        }
    }

}