<?php

namespace App\Repository\Admins\Post;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
use App\Model\Category;

class PostRepository implements PostRepositoryInterface
{
    const TABLE_NAME = 'posts';

    public function getList($_data)
    {
        $keyword = !empty($_data['keyword']) ? $_data['keyword'] : '';
        $category_id = !empty($_data['category_id']) ? $_data['category_id'] : [];
        return DB::table(self::TABLE_NAME)
            ->select('posts.*', 'categories.title as category_title')
            ->leftJoin('categories', 'posts.category_id', 'categories.id')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('posts.title', 'LIKE', '%' . $keyword . '%');
            })
            ->when($category_id, function ($query, $category_id) {
                return $query->whereIn('posts.category_id', $category_id);
            })

            ->orderBy('posts.id', 'DESC')

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

    public function destroyAll($_data)
    {
        try {
            if(empty($_data['check'])) return true;
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

}