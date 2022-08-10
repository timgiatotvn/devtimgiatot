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
        $deviceToken = $request->get('token');

        if (empty($deviceToken)) {

            return response()->json([
                'status' => 500,
                'message' => 'token không được để trống.',
            ]);
        }

        $device = Device::where('token', $deviceToken)->first();
        $arrId = [];
        if ($device) {
            $deviceReadNotification = DeviceReadNotification::where('device_id', $device->id)->get();
            $arrId = $deviceReadNotification->pluck('notification_id')->toArray();
        }

        $notifications = Notification::where(function ($query) use ($type, $arrId, $device) {
            if (empty($type)) {
                return $query->whereNotIn('id', $arrId)
                            ->where('created_at', '>', $device->created_at);
            }
        })->where('status', 1)->orderBy('id', 'DESC')
            ->paginate($perPage);

        foreach ($notifications as $notification) {

            $notification->created_at_format = !empty($notification->publish_at) ? date('d/m/Y H:i:s', strtotime($notification->publish_at)) : date('d/m/Y H:i:s', strtotime($notification->created_at));
            $notification->is_readed = false;
            if (in_array($notification->id, $arrId)) {
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

        if (empty($notification)) {
            return response()->json([
                'status' => 200,
                'message' => 'ok',
                'data' => []
            ]);
        }

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
