<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postadmin;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostadminController extends Controller
{
    public function index(){
        $posts = Postadmin::all();
        return view('backend.postsadmin.index', compact('posts'));
    }

    public function create(){
        $users = User::all();
        $categories = Category::all();
        return view('backend.postsadmin.create', compact('categories','users'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1500',
            'video' => 'required|mimes:mp4,avi,mkv,flv,webm|max:8192',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:8192',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $post = new Postadmin;
        $post->slug = Str::random(10);
        $post->name = $request['name'];
        $post->description = $request['description'];
        $post->category_id = $request['category_id'];
        $post->user_id = $request['user_id'];
        $storedvpath = null;
        if($request->hasFile('video')){
            $path = $request->file('video');
            $storedvpath = $path->store('admin_videos','public');
        }
        $storedipath = null;
        if($request->hasFile('image')){
            $ipath = $request->file('image');
            $storedipath = $ipath->store('admin_images','public');
        }
        $post->video = basename($storedvpath);
        $post->image = basename($storedipath);
        $post->save();
        return redirect()->route('postsadmin.index');
    }

    public function edit($slug){
        $post = Postadmin::where('slug', $slug)->first();
        $users = User::all();
        $categories = Category::all();
        $selectedcategory = $post->category_id;
        $selecteduser = $post->user_id;
        return view('backend.postsadmin.edit', compact('post','users','categories','selectedcategory','selecteduser'));
    }

    public function update(Request $request, $slug){
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1500',
            'video' => 'nullable|mimes:mp4,avi,mkv,flv,webm|max:8192',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:8192',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $post = Postadmin::where('slug', $slug)->first();
        $vpath = $post->video;
        $ipath = $post->image;
        if($request->hasFile('video')){
            if($post->video){
                Storage::disk('public')->delete('admin_videos/' . $post->video);
            }
            $path = $request->file('video');
            $vpath = $path->store('admin_videos','public');
        }
        if($request->hasFile('image')){
            if($post->image){
                Storage::disk('public')->delete('admin_images/' . $post->image);
            }
            $path = $request->file('image');
            $ipath = $path->store('admin_images','public');
        }
        $post->update([
            'slug' => Str::random(10),
            'name' => $request['name'],
            'description' => $request['description'],
            'video' => basename($vpath),
            'image' => basename($ipath),
            'category_id' => $request['category_id'],
            'user_id' => $request['user_id'],
        ]);
        return redirect()->route('postsadmin.index');
    }

    public function delete($slug){
        $post = Postadmin::where('slug', $slug)->first();
        if($post->video){
            Storage::disk('public')->delete('admin_videos/' . $post->video);
        }
        if($post->image){
            Storage::disk('public')->delete('admin_images/' . $post->image);
        }
        $post->prayers()->delete();
        $post -> delete();
        return redirect()->route('postsadmin.index');
    }
}
