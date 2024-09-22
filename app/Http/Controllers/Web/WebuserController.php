<?php

namespace App\Http\Controllers\Web;

use App\Models\Webuser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Storage;

class WebuserController extends Controller
{
    public function index(){
        $webusers = Webuser::all();
        return view('backend.webusers.index', compact('webusers'));
    }

    public function create(){
        return view('backend.webusers.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:webusers,email',
            'password' => 'required|min:8',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:5200'
        ]);
        $webuser = new Webuser;
        $webuser->name = $request['name'];
        $webuser->email = $request['email'];
        $webuser->password = Hash::make($request['password']);
        $webuser->save();
        if($request->hasFile('image')){
            $path = $request->file('image');
            $storedpath = $path->store('profilepictures', 'public');
            $webuser->profileImage()->create(['path' => basename($storedpath)]);
        }
        return redirect()->route('webusers.index');
    }

    public function edit($id){
        $webuser = Webuser::findOrFail($id);
        return view('backend.webusers.edit', compact('webuser'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8'
        ]);
        $webuser = Webuser::findOrFail($id);
        $webuser->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
        return redirect()->route('webusers.index');
    }

    public function delete($id){
        $webuser = Webuser::findOrFail($id);
        if ($webuser->profileImage) {
            Storage::disk('public')->delete('profilepictures/' . $webuser->profileImage->path);
            $webuser->profileImage->delete();
        }
        $webuser->posts()->each(function($post) {
            if ($post->image) {
                Storage::disk('public')->delete('images/' . $post->image);
            }
            if($post->video) {
                Storage::disk('public')->delete('videos/' . $post->video);
            }
            $post->prayers()->delete();
            $post->delete();
        });
        $webuser->delete();
        return redirect()->route('webusers.index');
    }
}
