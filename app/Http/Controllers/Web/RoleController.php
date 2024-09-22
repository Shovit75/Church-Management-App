<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('backend.roles.index', compact('roles'));
    }

    public function create(){
        $permissions = Permission::all();
        return view('backend.roles.create', compact('permissions'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'permissions.*' => 'exists:permissions,name' 
        ]);
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }
        return redirect()->route('roles.index');
    }

    public function edit($id){
        $role = Role::find($id);
        $permissions = Permission::all();
        $selectedpermissions = $role->permissions;
        $selectedPermissionsIds = $selectedpermissions->pluck('id')->toArray();
        return view('backend.roles.edit', compact('role','permissions','selectedPermissionsIds'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255',
            'permissions.*' => 'exists:permissions,name' 
        ]);
        $role = Role::find($id);
        $role->update([
            'name' => $request['name'],
            'guard_name' => 'web'
        ]);
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('roles.index');
    }

    public function delete($id){
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
