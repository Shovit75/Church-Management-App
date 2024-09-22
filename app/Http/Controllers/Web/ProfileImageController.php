<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProfileImage;
use App\Models\User;
use App\Models\Webuser;
use Storage;
use Auth;

class ProfileImageController extends Controller
{
    public function index(){
        if (Auth::user()->hasRole('CMS_admin')) {
            $profileimages = ProfileImage::where('Imageable_type', 'App\Models\Webuser')->get();
        } else {
            $profileimages = ProfileImage::all();
        }
        return view('backend.polymorphic_images.index', compact('profileimages'));
    }

    public function edit($id){
        $profileimage = ProfileImage::find($id);
        return view('backend.polymorphic_images.edit', compact('profileimage'));
    }

    public function update(Request $request, $id){
        $profileimage = ProfileImage::find($id);
        if($request->hasFile('image')){
            if ($profileimage->path) {
                Storage::disk('public')->delete('profilepictures/' . $profileimage->path);
            }
            $path = $request->file('image');
            $storedimage = $path->store('profilepictures', 'public');
            $profileimage->update([
                'path' =>  basename($storedimage)
            ]);
        }
        return redirect()->route('profileimages.index');
    }

    public function delete($id){
        $profileImage = ProfileImage::findOrFail($id);
        if ($profileImage->path) {
            Storage::disk('public')->delete('profilepictures/' . $profileImage->path);
        }
        $profileImage->delete();
        return redirect()->route('profileimages.index');
    }
}
