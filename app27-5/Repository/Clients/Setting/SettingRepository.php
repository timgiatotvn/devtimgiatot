<?php

namespace App\Repository\Clients\Setting;

use Illuminate\Support\Facades\DB;

class SettingRepository implements SettingRepositoryInterface
{
    const TABLE_NAME = 'settings';

    public function findFirst()
    {
        return DB::table(self::TABLE_NAME)->orderBy('id', 'DESC')->first();
    }


}