<?php

namespace App\Repository\Clients\Cart;

use Illuminate\Support\Facades\DB;

class ClientCartRepository implements ClientCartRepositoryInterface
{
    const TABLE_NAME = 'carts';
    const TABLE_NAME_ITEMS = 'cart_items';

    public function store($_data)
    {
        if (DB::table(self::TABLE_NAME)->insert($_data)) {
            return DB::table(self::TABLE_NAME)->orderByDesc('id')->first();
        } else {
            return [];
        }
    }

    public function storeItem($_data)
    {
        if (DB::table(self::TABLE_NAME_ITEMS)->insert($_data)) {
            return true;
        } else {
            return false;
        }
    }

}