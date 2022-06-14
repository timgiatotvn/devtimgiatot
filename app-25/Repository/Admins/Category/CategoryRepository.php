<?php

namespace App\Repository\Admins\Category;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    const TABLE_NAME = 'categories';

    public function getList($_data)
    {
        $keyword = !empty($_data['keyword']) ? $_data['keyword'] : '';
        $parent_id = !empty($_data['parent_id']) ? $_data['parent_id'] : [];
        $type = !empty($_data['type']) ? $_data['type'] : '';
        return DB::table(self::TABLE_NAME)->select('categories.*', 'admins.name as admin_name')
            ->leftJoin('admins', 'categories.admin_id', 'admins.id')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('categories.title', 'LIKE', '%' . $keyword . '%');
            })
            ->when($parent_id, function ($query, $parent_id) {
                return $query->where('categories.parent_id', ($parent_id != 'null') ? $parent_id : null);
            })
            ->when($type, function ($query, $type) {
                return $query->whereIn('categories.type', $type);
            })
            ->orderBy('categories.sort', 'ASC')
            ->paginate($_data['limit']);
    }

    public function getListMenu($_data)
    {
        $type = !empty($_data['type']) ? $_data['type'] : '';
        return DB::table(self::TABLE_NAME)
            ->select('id', 'title', 'parent_id')
            ->when($type, function ($query, $type) {
                return $query->whereIn('type', $type);
            })
            ->where('status', 1)
            ->orderBy('sort', 'ASC')
            ->get();
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

    public function findListParentId($_id)
    {
        return DB::table(self::TABLE_NAME)->select('id', 'title')->where('parent_id', $_id)->where('status', 1)->get();
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