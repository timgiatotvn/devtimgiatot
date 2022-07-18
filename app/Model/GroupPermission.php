<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GroupPermission extends Model
{
    protected $table = 'group_permissions';

    protected $fillable = [
        'name',
        'string'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
