<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Webuser;
use App\Models\Category;
use Hash;
use Str;
use Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        $R1 = Role::create(['name' => 'Superadmin','guard_name' => 'web']);
        $R2 = Role::create(['name' => 'CMS_admin','guard_name' => 'web']);

        $P1 = Permission::create(['name' => 'superadmin_permissions', 'guard_name' => 'web']);
        $P2 = Permission::create(['name' => 'cms_permissions', 'guard_name' => 'web']);

        $R1->givePermissionTo($P1);
        $R1->givePermissionTo($P2);
        $R2->givePermissionTo($P2);

        $user = new User;
        $user->name = 'asdf';
        $user->email = 'asdf@asdf.com';
        $user->password = Hash::make('asdf1234');
        $user->save();
        $imagePath = public_path('jesus.jpg');
        $storedPath = Storage::disk('public')->putFile('profilepictures', $imagePath);
        $user->profileImage()->create([
            'path' => basename($storedPath)
        ]);

        $webuser = new Webuser;
        $webuser->name = 'qwer';
        $webuser->email = 'qwer@qwer.com';
        $webuser->password = Hash::make('qwer1234');
        $webuser->save();
        $imagePath = public_path('default.jpg');
        $storedPath = Storage::disk('public')->putFile('profilepictures', $imagePath);
        $webuser->profileImage()->create([
            'path' => basename($storedPath)
        ]);
        
        $user->assignRole('Superadmin');

        $cat1 = Category::create([
            'slug' => Str::random(10),
            'name' => 'Sermons'
        ]);        
        $cat2 = Category::create([
            'slug' => Str::random(10),
            'name' => 'Bible Study'
        ]);
        
    }
}
