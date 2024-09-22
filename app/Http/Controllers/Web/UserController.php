<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Storage;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('backend.users.index', compact('users'));
    }

    public function create(){
        return view('backend.users.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:5200',
        ]);
        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();
        if($request->hasFile('image')){
            $path = $request->file('image');
            $storedpath = $path->store('profilepictures', 'public');
            $user->profileImage()->create(['path' => basename($storedpath)]);
        }
        $user->assignRole('CMS_admin');
        return redirect()->route('users.index');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8'
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
        return redirect()->route('users.index');
    }

    public function delete($id){
        $user = User::findOrFail($id);
        if ($user->profileImage) {
            Storage::disk('public')->delete('profilepictures/' . $user->profileImage->path);
            $user->profileImage->delete();
        }
        $user->adminposts()->each(function($post) {
            if ($post->image) {
                Storage::disk('public')->delete('admin_images/' . $post->image);
            }
            if($post->video) {
                Storage::disk('public')->delete('admin_videos/' . $post->video);
            }
            $post->prayers()->delete();
            $post->delete();
        });
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('users.index');
    }

}
