<?php

namespace App\Repository\Admins\Product;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
use App\Model\Category;

class ProductRepository implements ProductRepositoryInterface
{
    const TABLE_NAME = 'products';

    public function getList($_data)
    {
        $keyword = !empty($_data['keyword']) ? $_data['keyword'] : '';
        $category_id = !empty($_data['category_id']) ? $_data['category_id'] : [];
        $type = !empty($_data['type']) ? $_data['type'] : [];
        return DB::table(self::TABLE_NAME)
            ->select('products.*', 'categories.title as category_title')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('products.title', 'LIKE', '%' . $keyword . '%');
            })
            ->when($category_id, function ($query, $category_id) {
                return $query->whereIn('products.category_id', $category_id);
            })
            ->when($type, function ($query, $type) {
                return $query->where('products.type', $type);
            })
            ->orderBy('products.id', 'DESC')
            ->paginate($_data['limit']);
    }

    public function listAllCrawler(){
        return DB::table(self::TABLE_NAME)->where('type', "crawler")->get();
    }

    public function create($_data)
    {
        try {
            if (!$this->checkSlug($_data["slug"], "")) return false;
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
            if (!$this->checkSlug($_data["slug"], $_id)) return false;
            if (DB::table(self::TABLE_NAME)->where('id', $_id)->update($_data)) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateCrawler($_data, $_id)
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

    public function destroyAll($_data)
    {
        try {
            if (empty($_data['check'])) return true;
            if (DB::table(self::TABLE_NAME)->whereIn('id', $_data['check'])->delete()) {
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

    public function checkSlug($slug, $id)
    {
        $detail = DB::table(self::TABLE_NAME)->where('slug', $slug)->first();

        if (!empty($id)) {
            $detailById = DB::table(self::TABLE_NAME)->where('id', $id)->first();
            if ($detailById->slug == $slug) {
                return true;
            } else {
                if (empty($detail->id)) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            if (empty($detail->id)) {
                return true;
            } else {
                return false;
            }
        }
    }

}