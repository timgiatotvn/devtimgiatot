<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    protected $table = 'app_versions';

    protected $fillable = [
      'app_version',
      'note'
    ];
}
