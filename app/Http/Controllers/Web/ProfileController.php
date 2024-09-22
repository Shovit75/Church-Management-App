<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Webuser;
use Auth;

class ProfileController extends Controller
{
    public function showprofile(){
        $authuser_id = Auth::user()->id;
        $user = User::where('id', $authuser_id)->first();
        return view('backend.profile.index', compact('user'));
    }

    public function getwebuserprofile(){
        $authuser_id = Auth::guard('webuser')->user()->id;
        $user = Webuser::where('id', $authuser_id)->first();
        return view('frontend.profile', compact('user'));
    }
}
