<?php

namespace App\Repository\Admins\CrawlerCategory;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class CrawlerCategoryRepository implements CrawlerCategoryRepositoryInterface
{
    const TABLE_NAME = 'crawler_categories';

    public function getList($_data)
    {
        $keyword = !empty($_data['keyword']) ? $_data['keyword'] : '';
        $type = !empty($_data['type']) ? $_data['type'] : '';
        return DB::table(self::TABLE_NAME)->select('crawler_categories.*', 'admins.name as admin_name')
            ->leftJoin('admins', 'crawler_categories.admin_id', 'admins.id')
            ->when($type, function ($query, $type) {
                return $query->whereIn('crawler_categories.type', $type);
            })
            ->when($keyword, function ($query, $keyword) {
                return $query->where('crawler_categories.url', 'LIKE', '%' . $keyword . '%');
            })
            ->where('crawler_categories.crawler_website_id', $_data['crawler_website_id'])
            ->orderBy('crawler_categories.id', 'ASC')
            ->paginate($_data['limit']);
    }

    public function create($_data)
    {
        try {
            if (DB::table(self::TABLE_NAME)->insert($_data)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($_data, $_id)
    {
        try {
            if (DB::table(self::TABLE_NAME)->where('id', $_id)->update($_data)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function findById($_id)
    {
        return DB::table(self::TABLE_NAME)->where('id', $_id)->first();
    }

    public function updateStatus($_id, $_field, $_status)
    {
        try {
            if (DB::table(self::TABLE_NAME)->where('id', $_id)->update([$_field => $_status])) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function destroy($_id)
    {
        try {
            if (DB::table(self::TABLE_NAME)->where('id', $_id)->delete()) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

}