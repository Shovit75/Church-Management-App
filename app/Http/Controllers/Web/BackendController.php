<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Webuser;
use App\Models\Post;
use App\Models\Category;
use App\Models\Postadmin;
use App\Models\Event;
use App\Models\Donation;
use App\Models\Prayer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{

    //Authentication for Admin user

    public function index(){
        return view('backend.welcome');
    }

    public function signin(){
        return view('backend.adminauth.signin');
    }

    public function signup(){
        return view('backend.adminauth.signup');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:8',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:5200'
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
        return redirect()->route('backend.signin');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('backend.home');
        }
        return redirect()->back();
    }

    //Once Auth is done, we can now use
    //Homepage of the CMS
    public function home(){
        $users = User::count();
        $webusers = Webuser::count();
        $posts = Post::count();
        $cat = Category::count();
        $adminposts = Postadmin::count();
        $events = Event::count();
        $donation = Donation::count();
        $prayers = Prayer::sum('prayercount');
        return view('backend.dashboard', compact('users','webusers','posts','cat','adminposts','events','donation','prayers'));
    }

    //Logout admin user
    public function logout(){
        Auth::logout();
        return redirect()->route('backend.signin');
    }

}
