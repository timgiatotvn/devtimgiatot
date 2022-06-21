<?php

namespace App\Model;

use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    public function deviceReadNotification()
    {
        return $this->belongsToMany(Device::class, 'device_read_notifications');
    }

    public static function sendNotification($notification)
    {
        $deviceToken = Device::whereNotNull('token')->get()->pluck('token')->toArray();
        $fcmServerKey = env('FCM_SERVER_KEY');
        if (!empty($fcmServerKey)) {
            $data = [
                'registration_ids' => $deviceToken,
                'notification' => [
                    'title' => $notification->title,
                    'thumbnail' => Helpers::getUrlFile($notification->thumbnail),
                    'description' => $notification->description,
                    'date_time' => date('d/m/Y H:i:s', strtotime($notification->created_at)),
                    'link_detail' => route('api.notification.show', $notification->id)
                ]
            ];

            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=' . $fcmServerKey,
                'Content-Type: application/json',
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, env('FCM_SEND_API_LINK', 'https://fcm.googleapis.com/fcm/send'));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);
            $data = (json_decode($response, true));

            return $data;
        }
    }
}
