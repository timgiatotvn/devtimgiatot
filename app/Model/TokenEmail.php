<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TokenEmail extends Model
{
    protected $table = 'token_emails';

    protected $fillable = [
        'user_id',
        'token'
    ];
}
