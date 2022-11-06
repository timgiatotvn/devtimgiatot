<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdviseRequest extends Model
{
    protected $table = 'advise_requests';

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'address',
        'description'
    ];
}
