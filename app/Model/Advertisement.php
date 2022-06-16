<?php

namespace App\Model;

use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table = 'advertisements';

    static public function formatData($data)
    {
        foreach ($data as $item) {
            $item->thumbnail = Helpers::getUrlFile($item->thumbnail);
        }

        return $data;
    }
}
