<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Helpers\Helpers;
use App\Model\GroupPermission;
use App\Model\Permission;
use Modules\Admins\Http\Requests\Permissions\CreateRequest;

class PermissionController extends Controller
{
    public function list()
    {
        $data = [
            'permissions' => Permission::all(),
            'group_pms' => GroupPermission::with('permissions')->get()
        ];

        return view('admins::permissions.list', $data);
    }

    public function add()
    {
        $data = ['group_pms' => GroupPermission::all()];

        return view('admins::permissions.add', $data);
    }

    public function create(CreateRequest $request)
    {
        $data = $request->except('_token');
        $data['name'] = str_slug($request->name);
        Permission::create($data);

        return redirect()->route('admin.setting.permission.list')->with('success', 'Thêm thành công');
    }

    public function editForm($id)
    {
        $data = [
            'permission' => Permission::findOrFail($id),
            'group_pms' => GroupPermission::all()
        ];

        return view('admins::permissions.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $data['name'] = str_slug($request->name);

        Permission::whereId($id)->update($data);

        return redirect()->route('admin.setting.permission.list')->with('success', 'Sửa thành công'); 
    }

    public function delete($id)
    {
        Permission::whereId($id)->delete();

        return redirect()->route('admin.setting.permission.list')->with('success', 'Xóa thành công'); 
    }
}