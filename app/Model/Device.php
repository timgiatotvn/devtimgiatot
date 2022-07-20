<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';

    protected $fillable = [
        'token',
        'lat',
        'long',
        'type',
        'address',
        'city',
        'district',
        'note'
    ];
}
