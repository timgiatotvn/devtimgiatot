<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use App\Model\Notification;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth, DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.notification.index.title'), __('admins::layer.notification.index.title2')]);
            $data['list'] = Notification::with(['deviceReadNotification', 'user'])
                                        ->where('status', '!=', 3)
                                        ->orderBy('id', 'DESC')
                                        ->paginate(10);
            return view('admins::notifications.index', ['data' => $data]);
        } catch (\Exception $e) {Helpers::pre($e->getMessage());
            abort('500');
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('admins::notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

                $notification = new Notification();
                $notification->title = $request->get('title');
                $notification->thumbnail = $request->get('thumbnail');
                $notification->description = $request->get('description');
                $notification->content = $request->get('content');
                $notification->status = $request->get('status');
                if ($request->get('publish_at')) {
                    $notification->publish_at = \DateTime::createFromFormat('d/m/Y H:i:s', $request->get('publish_at'))->format('Y-m-d H:i:s');
                }
                $notification->admin_id = Auth::guard(\Helpers::renderGuard())->user()->id;
                $notification->save();

                if ($notification->status == 1) {
                    $result = Notification::sendNotification($notification);
                }
                DB::commit();
                if (isset($result) && $result['failure'] == 1) {
                    session()->flash('error', __('Không thể gửi thông báo tới app vui lòng kiểm tra lại'));
                }

            return redirect(route('notification.index'));
        } catch (\Exception $e) {
            DB::rollback();
            echo $e;
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admins::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $notification = Notification::find($id);

        return view('admins::notifications.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);
        $notification->title = $request->get('title');
        $notification->thumbnail = $request->get('thumbnail');
        $notification->description = $request->get('description');
        $notification->content = $request->get('content');
        $notification->status = $request->get('status');
        if ($request->get('publish_at')) {
            $notification->publish_at = \DateTime::createFromFormat('d/m/Y H:i:s', $request->get('publish_at'))->format('Y-m-d H:i:s');
        }
        $notification->admin_id = Auth::guard(\Helpers::renderGuard())->user()->id;
        $notification->save();

        return redirect(route('notification.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->delete();
        }

        session()->flash('success', __('Xoá thông báo thành công'));
        return redirect(route('notification.index'));

    }
}
