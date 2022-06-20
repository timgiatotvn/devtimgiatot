<?php

namespace App\Model;

use App\Model\User;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    public function deviceReadNotification()
    {
        return $this->belongsToMany(Device::class, 'device_read_notifications');
    }
}
