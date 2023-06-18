<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $table = "widgets";

    protected $fillable = [
        "name",
        "content"
    ];
}
