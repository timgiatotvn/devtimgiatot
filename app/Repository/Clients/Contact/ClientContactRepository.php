<?php

namespace App\Repository\Clients\Contact;

use Illuminate\Support\Facades\DB;

class ClientContactRepository implements ClientContactRepositoryInterface
{
    const TABLE_NAME = 'contacts';

    public function store($_data)
    {
        if (DB::table(self::TABLE_NAME)->insert($_data)) {
            return true;
        } else {
            return false;
        }
    }

}