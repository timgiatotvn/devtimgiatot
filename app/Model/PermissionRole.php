<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_roles';

    protected $fillable = [
        'role_id',
        'permission_id'
    ];
}
