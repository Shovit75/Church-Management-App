<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Webuser;
use App\Models\Category;
use App\Models\Prayer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('backend.posts.index', compact('posts'));
    }

    public function create(){
        $webusers = Webuser::all();
        $categories = Category::all();
        return view('backend.posts.create', compact('categories','webusers'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1500',
            'video' => 'required|mimes:mp4,avi,mkv,flv,webm|max:8192',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:8192',
            'category_id' => 'required|exists:categories,id',
            'webuser_id' => 'required|exists:webusers,id',
        ]);
        $post = new Post;
        $post->slug = Str::random(10);
        $post->name = $request['name'];
        $post->description = $request['description'];
        $post->category_id = $request['category_id'];
        $post->webuser_id = $request['webuser_id'];
        $storedvpath = null;
        if($request->hasFile('video')){
            $path = $request->file('video');
            $storedvpath = $path->store('videos','public');
        }
        $storedipath = null;
        if($request->hasFile('image')){
            $ipath = $request->file('image');
            $storedipath = $ipath->store('images','public');
        }
        $post->video = basename($storedvpath);
        $post->image = basename($storedipath);
        $post->save();
        return redirect()->route('posts.index');
    }

    public function edit($slug){
        $post = Post::where('slug', $slug)->first();
        $webusers = Webuser::all();
        $categories = Category::all();
        $selectedcategory = $post->category_id;
        $selectedwebuser = $post->webuser_id;
        return view('backend.posts.edit', compact('post','webusers','categories','selectedcategory','selectedwebuser'));
    }

    public function update(Request $request, $slug){
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1500',
            'video' => 'nullable|mimes:mp4,avi,mkv,flv,webm|max:8192',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:8192',
            'category_id' => 'required|exists:categories,id',
            'webuser_id' => 'required|exists:webusers,id',
        ]);
        $post = Post::where('slug', $slug)->first();
        $vpath = $post->video;
        $ipath = $post->image;
        if($request->hasFile('video')){
            if($post->video){
                Storage::disk('public')->delete('videos/' . $post->video);
            }
            $path = $request->file('video');
            $vpath = $path->store('videos','public');
        }
        if($request->hasFile('image')){
            if($post->image){
                Storage::disk('public')->delete('images/' . $post->image);
            }
            $path = $request->file('image');
            $ipath = $path->store('images','public');
        }
        $post->update([
            'slug' => Str::random(10),
            'name' => $request['name'],
            'description' => $request['description'],
            'video' => basename($vpath),
            'image' => basename($ipath),
            'category_id' => $request['category_id'],
            'webuser_id' => $request['webuser_id'],
        ]);
        return redirect()->route('posts.index');
    }

    public function delete($slug){
        $post = Post::where('slug', $slug)->first();
        if($post->video){
            Storage::disk('public')->delete('videos/' . $post->video);
        }
        if($post->image){
            Storage::disk('public')->delete('images/' . $post->image);
        }
        $post->prayers()->delete();
        $post -> delete();
        return redirect()->route('posts.index');
    }
}
