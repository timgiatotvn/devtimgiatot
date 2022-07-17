<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Model\GroupPermission;
use Modules\Admins\Http\Requests\Permissions\CreateRequest;

class GroupPermissionController extends Controller
{
    public function list()
    {
        $data = [
            'permissions' => GroupPermission::all()
        ];

        return view('admins::group_permissions.list', $data);
    }

    public function add()
    {
        return view('admins::group_permissions.add');
    }

    public function create(Request $request)
    {
        GroupPermission::create($request->except('_token'));

        return redirect()->route('admin.setting.group_permission.list')->with('success', 'Thêm thành công');
    }

    public function editForm($id)
    {
        $data = [
            'permission' => GroupPermission::findOrFail($id)
        ];

        return view('admins::group_permissions.edit', $data);
    }

    public function update(Request $request, $id)
    {
        GroupPermission::whereId($id)->update($request->except('_token'));

        return redirect()->route('admin.setting.group_permission.list')->with('success', 'Sửa thành công'); 
    }

    public function delete($id)
    {
        GroupPermission::whereId($id)->delete();

        return redirect()->route('admin.setting.group_permission.list')->with('success', 'Xóa thành công'); 
    }
}