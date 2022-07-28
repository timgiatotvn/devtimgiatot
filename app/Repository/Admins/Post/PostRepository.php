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
        $month = !empty($_data['month']) ? $_data['month'] : 'all';
        $year = !empty($_data['year']) ? $_data['year'] : 'all';
        $type = !empty($_data['type']) ? $_data['type'] : 'all';
        $admin_id = !empty($_data['admin_id']) ? $_data['admin_id'] : 'all';
        $status = !empty($_data['status']) ? $_data['status'] : 'all';
        $category_id = !empty($_data['category_id']) ? $_data['category_id'] : [];
        $roles = auth('admins')->user()->roles->pluck('name')->toArray();
        $col= !empty($_data['col_order']) ? $_data['col_order'] : 'all';
        $type_order= !empty($_data['type_order']) ? $_data['type_order'] : 'DESC';
        $col_order = 'posts.'.$col;
        return DB::table(self::TABLE_NAME)
                ->select('posts.*', 'categories.title as category_title')
                ->leftJoin('categories', 'posts.category_id', 'categories.id')
                ->when($keyword, function ($query, $keyword) {
                    return $query->where('posts.title', 'LIKE', '%' . $keyword . '%');
                })
                ->when($category_id, function ($query, $category_id) {
                    return $query->whereIn('posts.category_id', $category_id);
                })
                ->when($type, function ($query, $type) {
                    if ($type != 'all' && $type == 'crawl') {
                        return $query->whereNotNull('link_origin_encode');
                    } else if ($type != 'all' && $type == 'handle') {
                        return $query->whereNull('link_origin_encode');
                    }
                })
                ->when($roles, function ($query, $roles) {
                    if (!in_array('Admin', $roles)) {
                        return $query->where('posts.admin_id', auth('admins')->user()->id)
                                     ->orWhere('posts.admin_id', -1);
                    }
                })
                ->when($admin_id, function ($query, $admin_id) {
                    if ($admin_id != 'all') {
                        return $query->where('posts.admin_id', $admin_id);
                    }
                })
                ->when($status, function ($query, $status) {
                    if ($status != 'all') {
                        return $query->where('posts.status', $status == -1 ? 0 : $status);
                    }
                })
                ->when($month, function ($query, $month) {
                    if ($month != 'all') {
                        return $query->whereMonth('date_edit', $month < 10 ? '0' . $month : $month);
                    }
                })
                ->when($year, function ($query, $year) {
                    if ($year != 'all') {
                        return $query->whereYear('date_edit', $year);
                    }
                })
                ->orderBy($col_order, $type_order)
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