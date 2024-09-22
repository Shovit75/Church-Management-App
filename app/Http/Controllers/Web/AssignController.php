<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignController extends Controller
{
    public function index(){
        $users = User::all();
        return view('backend.assign.index', compact('users'));
    }

    public function edit($id){
        $roles = Role::all();
        $user = User::find($id);
        $selectedrole = $user->role;
        return view('backend.assign.edit', compact('user','roles','selectedrole'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->syncRoles($request->role);
        return redirect()->route('assign.index');
    }
}
