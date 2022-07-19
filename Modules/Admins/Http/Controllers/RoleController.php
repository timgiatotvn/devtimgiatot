<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Helpers\Helpers;
use App\Model\GroupPermission;
use App\Model\PermissionRole;
use App\Model\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function list()
    {
        $data = [
            'roles' => Role::all(),
        ];

        return view('admins::roles.list', $data);
    }

    public function add()
    {
        $data = [
            'group_pms' => GroupPermission::with('permissions')->get()
        ];

        return view('admins::roles.add', $data);
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $role = Role::create($request->except('_token', 'permissions'));
            $permission_roles = [];

            if (!empty($request->permissions)) {
                foreach ($request->permissions as $permission_id) {
                    $permission_roles[] = [
                        'role_id' => $role->id,
                        'permission_id' => $permission_id
                    ];
                }
            }
            
            if (count($permission_roles) > 0) {
                PermissionRole::insert($permission_roles);
            }
            DB::commit();

            return redirect()->route('admin.setting.role.list')->with('success', 'Thêm thành công');
        } catch (\Throwable $th) {
            DB::rollBack();

            return back()->with('error', 'Vui lòng thử lại');
        }
        
    }

    public function editForm($id)
    {
        $data = [
            'role' => Role::findOrFail($id),
            'permission_roles' => PermissionRole::where('role_id', $id)->pluck('permission_id')->toArray(),
            'group_pms' => GroupPermission::with('permissions')->get()
        ];

        return view('admins::roles.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            Role::whereId($id)->update($request->except('_token', 'permissions'));
            PermissionRole::where('role_id', $id)->delete();
            foreach ($request->permissions as $permission_id) {
                $permission_roles[] = [
                    'role_id' => $id,
                    'permission_id' => $permission_id
                ];
            }
            if (count($permission_roles) > 0) {
                PermissionRole::insert($permission_roles);
            }
            DB::commit();
            
            return redirect()->route('admin.setting.role.list')->with('success', 'Sửa thành công'); 
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('admin.setting.role.list')->with('error', 'Vui lòng thử lại'); 
        }
    }

    public function delete($id)
    {
        Role::whereId($id)->delete();

        return redirect()->route('admin.setting.role.list')->with('success', 'Xóa thành công'); 
    }
}