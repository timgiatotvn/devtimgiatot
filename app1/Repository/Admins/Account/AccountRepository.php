<?php

namespace App\Repository\Admins\Account;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class AccountRepository implements AccountRepositoryInterface
{
    const TABLE_NAME = 'admins';

    public function getList($_data)
    {
        $keyword = !empty($_data['keyword']) ? $_data['keyword'] : '';
        return DB::table(self::TABLE_NAME)
            ->when($keyword, function ($query, $keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->orderBy('id', 'ASC')
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

    public function updateStatus($_id, $_status)
    {
        try {
            if (DB::table(self::TABLE_NAME)->where('id', $_id)->update(['status' => $_status])) {
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