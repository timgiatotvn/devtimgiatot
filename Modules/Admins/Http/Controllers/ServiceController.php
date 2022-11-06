<?php

namespace Modules\Admins\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\AdviseRequest;
use App\Model\Category;
use App\Model\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function list()
    {
        $data = [
            'services' => Service::latest()->paginate(20)
        ];

        return view('admins::services.list', $data);
    }

    public function add()
    {
        $data = [
            'category' => Category::where('type', 'service')->get(),
            'provinces' => DB::table('provinces')->get()
        ];

        return view('admins::services.add', $data);
    }

    public function getDistrict(Request $request)
    {
        $districts = DB::table('districts')->where('province_id', $request->province_id)->get();
        
        return response()->json(['success' => true, 'data' => $districts]);
    }

    public function edit($id)
    {
        $service = Service::find($id);
        $data = [
            'category' => Category::where('type', 'service')->get(),
            'service' => $service,
            'districts' => DB::table('districts')->where('province_id', $service->province_id)->get(),
            'provinces' => DB::table('provinces')->get()
        ];

        return view('admins::services.edit', $data);
    }

    public function storeService(Request $request)
    {
        try {
            $inputs = $request->except('_token');
            $inputs['slug'] = str_slug($inputs['title']);
            Service::create($inputs);

            return redirect()->route('admin.service.index')->with('success', 'Thêm dịch vụ thành công');
        } catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Vui lòng thử lại');
        }
    }

    public function listRequestAdvise()
    {
        $requests = AdviseRequest::all();

        return view('admins::requests.index', [
            'requests' => $requests
        ]);
    }

    public function delete($id)
    {
        Service::whereId($id)->delete();

        return redirect()->route('admin.service.index')->with('success', 'Xóa thành công');
    }

    public function updateService(Request $request, $id)
    {
        try {
            $service = Service::find($id);
            $inputs = $request->except('_token');
            $inputs['slug'] = $service->slug;
            $service->update($inputs);

            return redirect()->route('admin.service.index')->with('success', 'Cập nhật dịch vụ thành công');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->withInput()->with('error', 'Vui lòng thử lại');
        }
    }
}