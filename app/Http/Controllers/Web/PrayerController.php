<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prayer;
use Auth;

class PrayerController extends Controller
{
    public function index(){
        if (Auth::user()->hasRole('CMS_admin')) {
            $prayers = Prayer::where('Prayable_type', 'App\Models\Post')->get();
        } else {
            $prayers = Prayer::all();
        }
        return view('backend.polymorphic_prayers.index', compact('prayers'));
    }

    public function delete($id){
        $prayers = Prayer::find($id);
        $prayers->delete();
        return redirect()->route('prayers.index');
    }
}
