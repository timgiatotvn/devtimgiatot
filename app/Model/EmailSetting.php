<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    protected $table = 'email_settings';

    protected $fillable = [
        'driver',
        'host',
        'port',
        'from_email',
        'from_name',
        'encryption',
        'username',
        'password',
    ];
}
