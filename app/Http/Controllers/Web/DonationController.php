<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index(){
        $donate = Donation::all();
        return view('backend.donations.index', compact('donate'));
    }

    public function create(){
        return view('backend.donations.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'required|url|max:100',
            'phone' => 'nullable|integer|min:1',
        ]);
        $donate = new Donation;
        $donate->name = $request['name'];
        $donate->url = $request['url'];
        $donate->phone = $request['phone'];
        $donate->save();
        return redirect()->route('donations.index');
    }

    public function edit($id){
        $donate = Donation::find($id);
        return view('backend.donations.edit', compact('donate'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:255',
            'url' => 'required|url|max:100',
            'phone' => 'nullable|integer|min:1',
        ]);
        $donate = Donation::find($id);
        $donate->update([
            'name' => $request['name'],
            'url' => $request['url'],
            'phone' => $request['phone'],
        ]);
        return redirect()->route('donations.index');
    }

    public function delete($id){
        $donate = Donation::find($id);
        $donate->delete();
        return redirect()->route('donations.index');
    }
}
