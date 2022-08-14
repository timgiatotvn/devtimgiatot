<?php

namespace App\Repository\Clients\User;

use App\Model\Admin;
use App\Model\RoleAdmin;
use Illuminate\Support\Facades\DB;

class ClientUserRepository implements ClientUserRepositoryInterface
{
    const TABLE_NAME = 'users';

    public function store($_data)
    {
        // try {
        //     DB::beginTransaction();
        //     $admin = Admin::create($_data);
        //     RoleAdmin::create([
        //         'role_id' => 2,
        //         'admin_id' => $admin->id
        //     ]);
        //     DB::commit();
            
        //     return true;
        // } catch (\Throwable $th) {
        //     DB::rollBack();

        //     return false;
        // }
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