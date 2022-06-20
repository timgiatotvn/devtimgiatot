<?php

namespace App\Repository\Admins\Setting;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;


class SettingRepository implements SettingRepositoryInterface
{
    const TABLE_NAME = 'settings';


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


}