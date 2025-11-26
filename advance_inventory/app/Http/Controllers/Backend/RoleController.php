<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
}
