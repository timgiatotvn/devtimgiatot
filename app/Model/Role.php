<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'description'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, PermissionRole::class);
    }
}
