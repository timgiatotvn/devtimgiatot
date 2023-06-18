<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryWp extends Model
{
    protected $table = "category_wps";

    protected $fillable = [
        "name",
        "link",
        "parent_id",
        "position"
    ];
}
