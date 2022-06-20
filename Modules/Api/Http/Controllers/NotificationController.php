<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\Helpers;
use App\Model\Device;
use App\Model\DeviceReadNotification;
use App\Model\Notification;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $type = $request->get('type') ? $request->get('type') : null;

        $notifications = Notification::where(function ($query) use ($type) {
            if (empty($type)) {
                return $query->doesntHave('deviceReadNotification');
            }
        })->where('status', 1)->orderBy('id', 'DESC')
            ->paginate($perPage);

        foreach ($notifications as $notification) {
            $notification->is_readed = false;
            if (count($notification->deviceReadNotification) > 0) {
                $notification->is_readed = true;
            }
            $notification->thumbnail = Helpers::getUrlFile($notification->thumbnail);
        }

        return response()->json([
            'status' => 200,
            'message' => 'ok',
            'data' => $notifications
        ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @param Request $request
     * @return Renderable
     */
    public function show($id, Request $request)
    {
        $deviceToken = $request->get('token');
        if (empty($id)) {

            return response()->json([
                'status' => 500,
                'message' => 'id không được để trống.',
            ]);
        }
        $notification = Notification::find($id);
        $notification->thumbnail = Helpers::getUrlFile($notification->thumbnail);
        if ($deviceToken) {
            $device = Device::where('token', $deviceToken)->first();
            if (!empty($device)) {
                $userReadNotify = DeviceReadNotification::where('device_id', $device->id)
                    ->where('notification_id', $id)->first();
                if (empty($userReadNotify)) {
                    $userReadNotication = new DeviceReadNotification();
                    $userReadNotication->device_id = $device->id;
                    $userReadNotication->notification_id = $notification->id;
                    $userReadNotication->save();
                }
            }
        }


        return response()->json([
            'status' => 200,
            'message' => 'ok',
            'data' => $notification
        ]);
    }
}
