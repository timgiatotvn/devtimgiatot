<?php

namespace Modules\Admins\Http\Controllers;

use App\Service\Admins\SettingService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Helpers\Helpers;
use Illuminate\Support\MessageBag;
use App\Service\Admins\Setting;

class SettingsController extends Controller
{

    private $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }


    public function edit($id){
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.setting.edit.title'), __('admins::layer.setting.index.title2')]);
            $data['detail'] = $this->settingService->findById($id);
            if (empty($data['detail']->id)) return abort(404);

            return view('admins::settings.edit', ['data' => $data]);
        } catch (\Exception $e) {
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data['detail'] = $this->settingService->findById($id);
            if (empty($data['detail']->id)) return abort(404);
            $_params = $request->all();
            if ($this->settingService->update($_params, $id)) {
                session()->flash('success', __('admins::layer.notify.success'));
                return redirect(route('admin.setting.update', ['id' => $id]));
            } else {
                $errors = new MessageBag(['error' => __('admins::layer.notify.fail')]);
                return back()->withInput($_params)->withErrors($errors);
            }
        } catch (\Exception $e) {
            return !empty($e->getMessage()) ? abort('500') : abort(404);
        }
    }


}
