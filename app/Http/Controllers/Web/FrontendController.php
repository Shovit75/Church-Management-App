<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Event;
use App\Models\Donation;
use App\Models\Postadmin;
use App\Models\Webuser;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Hash;
use Str;

class FrontendController extends Controller
{
    public function home(){
        $allposts = DB::table('posts')
        ->select('slug','name','description','image','created_at')
        ->union(DB::table('postadmins')->select('slug','name','description','image','created_at'))
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        $adminposts = Postadmin::paginate(3);
        $posts = Post::paginate(2);
        return view('frontend.index', compact('posts','adminposts','allposts'));
    }

    //Authenticating the webusers
    public function loginpage(){
        return view('frontend.auth.login');
    }

    public function registerpage(){
        return view('frontend.auth.register');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:webusers,email',
            'password' => 'required|min:8'
        ]);
        if(Auth::guard('webuser')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('frontend.home');
        }
        return redirect()->route('frontend.signin');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:webusers,email|max:255',
            'password' => 'required|min:8',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:5200'
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
        return redirect()->route('frontend.signin');
    }

    public function logout(){
        Auth::guard('webuser')->logout();
        return redirect()->route('frontend.signin');
    }

    //show posts of admin and webusers
    public function showposts(){
        $posts = Post::all();
        return view('frontend.showposts', compact('posts'));
    }

    public function adminshowposts(){
        $posts = Postadmin::all();
        return view('frontend.showadminposts', compact('posts'));
    }

    public function pray(Request $request, $slug){
        $post = Post::where('slug', $slug)->first();
        $creator_id = $post->webuser_id;
        $authuser_id = Auth::guard('webuser')->user()->id;

        //Not allow the creator to pray his own post
        if($creator_id == $authuser_id){
            dd("User not allowed to pray their own posts");
        }

        //Check for prayers in posts and not allow the auth user to pray the same post twice
        $prayer = $post->prayers()->first(); 
        // Get prayedusers if $prayer exists, otherwise empty array
        $prayedusers = $prayer ? $prayer->prayedusers : [];
        if (in_array($authuser_id, $prayedusers)) {
            dd("User not allowed to pray for the same post twice");
        }

        // Create or update the prayer record
        if ($prayer) {
            // Add the user ID to prayedusers array and update prayercount
            $prayedusers[] = $authuser_id;
            // To ensure no double entry
            $prayer->prayedusers = array_unique($prayedusers);
            $prayer->prayercount += 1;
            $prayer->save();
        } else {
            $post->prayers()->create([
                'prayercount' => 1,
                'prayedusers' => [$authuser_id],
            ]);
        }
        return redirect()->route('frontend.posts');
    }

    public function adminpray(Request $request, $slug){
        $post = Postadmin::where('slug', $slug)->first();
        $creator_id = $post->user_id;
        $authuser_id = Auth::guard('webuser')->user()->id;

        //Check for prayers in posts and not allow the auth user to pray the same post twice
        $prayer = $post->prayers()->first(); 
        // Get prayedusers if $prayer exists, otherwise empty array
        $prayedusers = $prayer ? $prayer->prayedusers : [];
        if (in_array($authuser_id, $prayedusers)) {
            dd("User not allowed to pray for the same post twice");
        }

        // Create or update the prayer record
        if ($prayer) {
            // Add the user ID to prayedusers array and update prayercount
            $prayedusers[] = $authuser_id;
            // To ensure no double entry
            $prayer->prayedusers = array_unique($prayedusers);
            $prayer->prayercount += 1;
            $prayer->save();
        } else {
            $post->prayers()->create([
                'prayercount' => 1,
                'prayedusers' => [$authuser_id],
            ]);
        }
        return redirect()->route('frontend.admin.posts');
    }

    public function showevents(){
        $events = Event::all();
        return view('frontend.showallevents', compact('events'));
    }

    public function participate($id){
        $event = Event::find($id);
        $authuser_id = Auth::guard('webuser')->user()->id;        
        $participants = $event->participants ?? [];    
        if (in_array($authuser_id, $participants)) {
            dd("User can't participate twice");
        }    
        $participants[] = $authuser_id;    
        $event->update([
            'participants' => $participants
        ]);
        return redirect()->route('frontend.events');
    }

    public function donations(){
        $donations = Donation::all();
        return view('frontend.showalldonations', compact('donations'));
    }

    public function upload(){
        $categories = Category::all();
        return view('frontend.upload', compact('categories'));
    }

    public function uploadpost(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:1500',
            'video' => 'required|mimes:mp4,avi,mkv,flv,webm|max:8192',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:8192',
            'category_id' => 'required|exists:categories,id',
            ]);
        $post = new Post;
        $post->slug = Str::random(10);
        $post->name = $request['name'];
        $post->description = $request['description'];
        $post->category_id = $request['category_id'];
        $post->webuser_id = Auth::guard('webuser')->user()->id;
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
        return redirect()->route('frontend.posts');
    }

}
