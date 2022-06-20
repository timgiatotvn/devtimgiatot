<?php

namespace App\Repository\Admins\CrawlerWebsite;

use App\Helpers\Helpers;
use App\Model\CrawlerCategory;
use App\Model\CrawlerWebsite;
use Illuminate\Support\Facades\DB;

class CrawlerWebsiteRepository implements CrawlerWebsiteRepositoryInterface
{
    const TABLE_NAME = 'crawler_websites';
    private $model;

    public function __construct()
    {
        $this->model = new CrawlerWebsite();
    }

    public function getList($_data)
    {
        $keyword = !empty($_data['keyword']) ? $_data['keyword'] : '';
        $parent_id = !empty($_data['parent_id']) ? $_data['parent_id'] : [];
        $type = !empty($_data['type']) ? $_data['type'] : '';
        return $this->model->select('crawler_websites.*', 'admins.name as admin_name')
            ->leftJoin('admins', self::TABLE_NAME . '.admin_id', 'admins.id')
            //->with('crawlerCategoryCount')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('crawler_websites.title', 'LIKE', '%' . $keyword . '%');
            })
            ->when($type, function ($query, $type) {
                return $query->whereIn('crawler_websites.type', $type);
            })
            ->orderBy('crawler_websites.id', 'ASC')
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