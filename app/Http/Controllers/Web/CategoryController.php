<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $cat = Category::all();
        return view('backend.categories.index', compact('cat'));
    }

    public function create(){
        return view('backend.categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $slug = Str::random(10);
        while (Category::where('slug', $slug)->exists()) {
            $slug = Str::random(10);
        }
        $cat = new Category;
        $cat->name = $request['name'];
        $cat->slug = $slug;
        $cat->save();
        return redirect()->route('categories.index');
    }

    public function edit($slug){
        $cat = Category::where('slug', $slug)->first();
        return view('backend.categories.edit', compact('cat'));
    }

    public function update(Request $request, $slug){
        $request->validate([
            'name' => 'required|max:255',
        ]);
        $newslug = Str::random(10);
        $cat = Category::where('slug', $slug)->first();
        $cat->update([
            'name' => $request['name'],
            'slug' => $newslug
        ]);
        return redirect()->route('categories.index');
    }

    public function delete($slug){
        $cat = Category::where('slug', $slug)->first();
        $cat->delete();
        return redirect()->route('categories.index');
    }
}
