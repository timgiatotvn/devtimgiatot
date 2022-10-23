<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $table = 'payment_settings';

    protected $fillable = [
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'qr_code'
    ];
}
