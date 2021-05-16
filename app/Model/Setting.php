<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model
{
    protected $table = 'settings';

    public static function getbyID($id){
        $result = Setting::where('id', '=', $id)
            ->first();
        return $result;
    }
}
