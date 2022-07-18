<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleAdmin extends Model
{
    protected $table = 'role_admins';

    protected $fillable = [
        'role_id',
        'admin_id'
    ];
}
