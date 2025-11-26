<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;



class RoleController extends Controller
{
    //AllPermission

    public function AllPermission()
    {
        $permissions = Permission::all();
        return view('admin.backend.pages.permission.all_permission', compact('permissions'));
    }
    //AddPermission
    public function AddPermission()
    {
        return view('admin.backend.pages.permission.add_permission');
    }

    //StorePermission
    public function StorePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions',
            'group_name' => 'required',
        ]);

        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }
    //EditPermission
    public function EditPermission($id)
    {
        $permissions = Permission::find($id);
        return view('admin.backend.pages.permission.edit_permission', compact('permissions'));
    }
    //UpdatePermission
    public function UpdatePermission(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
            'group_name' => 'required',
        ]);

        Permission::findOrFail($id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    //DeletePermission
    public function DeletePermission($id)
    {
        $permission = Permission::find($id);
        if ($permission) {
            $permission->delete();

            $notification = array(
                'message' => 'Permission Deleted Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Permission not found',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('all.permission')->with($notification);
    }

    //AllRoles
    public function AllRoles()
    {
        $roles = Role::all();
        return view('admin.backend.pages.role.all_role', compact('roles'));
    }

    //AddRole
    public function AddRoles()
    {
        return view('admin.backend.pages.role.add_role');
    }
    //StoreRole
    public function StoreRoles(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }

    //EditRole
    public function EditRoles($id)
    {
        $roles = Role::find($id);
        return view('admin.backend.pages.role.edit_role', compact('roles'));
    }
    //UpdateRole
    public function UpdateRoles(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
        ]);

        Role::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    }

    //DeleteRole
    public function DeleteRoles($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();

            $notification = array(
                'message' => 'Role Deleted Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Role not found',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('all.roles')->with($notification);
    }

    // /AddRolesPermission
    public function AddRolesPermission()
    {
        $permission_groups = Permission::select('group_name')->distinct()->get();
        $roles = Role::all();
        return view('admin.backend.pages.rolesetup.add_roles_permission', compact('permission_groups', 'roles'));
    }

    //RolePermissionStore
    public function RolePermissionStore(Request $request)
    {
        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;
            //    RoleHasPermission::create($data);
            DB::table('role_has_permissions')->insert($data);
        }

        //notification
        $notification = array(
            'message' => 'Role Permission Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }

    // /AllRolesPermission
    public function AllRolesPermission()
    {
        $roles = Role::all();
        return view('admin.backend.pages.rolesetup.all_roles_permission', compact('roles'));
    }

    //AdminEditRoles
    public function AdminEditRoles($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('admin.backend.pages.rolesetup.edit_roles_permission', compact('role', 'permissions', 'permission_groups'));
    }

    //AdminRolesUpdate
    public function AdminRolesUpdate(Request $request, $id)
    {
        $role = Role::find($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $perminsionNames = Permission::whereIn('id', $permissions)->pluck('name')->toArray();
            $role->syncPermissions($perminsionNames);
        } else {
            $role->syncPermissions([]);
        }
        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }

    //AdminDeleteRoles
    public function AdminDeleteRoles($id)
    {
        $role = Role::find($id);
        if (!is_null($role)) {
            $role->delete();
            $notification = array(
                'message' => 'Role Deleted Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Role not found',
                'alert-type' => 'error'
            );
        }

        return redirect()->route('all.roles.permission')->with($notification);
    }
}
