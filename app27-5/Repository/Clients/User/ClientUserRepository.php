<?php

namespace App\Repository\Clients\User;

use Illuminate\Support\Facades\DB;

class ClientUserRepository implements ClientUserRepositoryInterface
{
    const TABLE_NAME = 'users';

    public function store($_data)
    {
        if (DB::table(self::TABLE_NAME)->insert($_data)) {
            return true;
        } else {
            return false;
        }
    }

    public function update($_data, $_id)
    {
        try {
            if (DB::table(self::TABLE_NAME)->where('id', $_id)->update($_data)) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }


}