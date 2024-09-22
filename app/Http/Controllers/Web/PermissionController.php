<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('backend.permissions.index', compact('permissions'));
    }

    public function create(){
        return view('backend.permissions.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
        ]);
        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        return redirect()->route('permissions.index');
    }

    public function edit($id){
        $permission = Permission::find($id);
        return view('backend.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $permission = Permission::find($id);
        $permission->update([
            'name' => $request['name'],
            'guard_name' => 'web'
        ]);
        return redirect()->route('permissions.index');
    }

    public function delete($id){
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permissions.index');
    }
}
