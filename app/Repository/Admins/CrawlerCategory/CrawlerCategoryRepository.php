<?php

namespace App\Repository\Admins\CrawlerCategory;

use App\Helpers\Helpers;
use App\Jobs\jobDemoCrawler;
use App\Model\CrawlerCategory;
use Illuminate\Support\Facades\DB;

class CrawlerCategoryRepository implements CrawlerCategoryRepositoryInterface
{
    const TABLE_NAME = 'crawler_categories';

    private $model;

    public function __construct()
    {
        $this->model = new CrawlerCategory();
    }

    public function getList($_data)
    {
        $keyword = !empty($_data['keyword']) ? $_data['keyword'] : '';
        $type = !empty($_data['type']) ? $_data['type'] : '';
        return $this->model->with('admin')
            ->with('article')
            ->when($type, function ($query, $type) {
                return $query->whereIn('crawler_categories.type', $type);
            })
            ->when($keyword, function ($query, $keyword) {
                return $query->where('crawler_categories.url', 'LIKE', '%' . $keyword . '%');
            })
            ->where('crawler_categories.crawler_website_id', $_data['crawler_website_id'])
//            ->where('articles.type', "demo")
//            ->orderBy('articles.id', 'DESC')
            ->orderBy('crawler_categories.id', 'ASC')
            ->paginate($_data['limit']);
    }

    public function create($_data)
    {
        try {
            if (DB::table(self::TABLE_NAME)->insert($_data)) {
                $detail = DB::table(self::TABLE_NAME)->orderByDesc("id")->first();
                Helpers::queueWriteJson($detail->id, "first");
//                jobDemoCrawler::dispatch($detail)->delay(now()->addSeconds(2));
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
                $detail = DB::table(self::TABLE_NAME)->where('id', $_id)->first();
                Helpers::queueWriteJson($detail->id, "first");
//                jobDemoCrawler::dispatch($detail)->delay(now()->addSeconds(2));
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