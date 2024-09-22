<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Artisan;

class SeederController extends Controller
{
    public function dbseed(){
        if(User::count() == 0 && Role::count() == 0 && Permission::count() == 0){
            Artisan::call('db:seed', [
                '--class' => 'DatabaseSeeder'
            ]);
            return redirect()->back()->with('success', 'Seed Successful!');
        }
        return redirect()->back()->with('error', 'Already Seeded!');
    }
}
