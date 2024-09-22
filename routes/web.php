<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\WebuserController;
use App\Http\Controllers\Web\FrontendController;
use App\Http\Controllers\Web\BackendController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\PostadminController;
use App\Http\Controllers\Web\PostsAuthController;
use App\Http\Controllers\Web\ProfileImageController;
use App\Http\Controllers\Web\PrayerController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\DonationController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\AssignController;
use App\Http\Controllers\SeederController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Seed the Database with admin user, roles and permissions
Route::get('/run-seeder', [SeederController::class, 'dbseed'])->name('dbseed');

//Backend
Route::get('/', [BackendController::class, 'index'])->name('index.homepage');
Route::get('/backendsignin', [BackendController::class, 'signin'])->name('backend.signin');
Route::get('/backendsignup', [BackendController::class, 'signup'])->name('backend.signup');
Route::post('/backendloginuser', [BackendController::class, 'login'])->name('backend.loginuser');
Route::post('/backendregisteruser', [BackendController::class, 'register'])->name('backend.registeruser');

//Custom middlware to check Auth of backend with Route Grouping
Route::middleware('auth.backend.check')->group(function(){
    //once authenticated we redirect to dashboard
    Route::get('/backendhome', [BackendController::class, 'home'])->name('backend.home');

    Route::middleware('role:Superadmin')->group(function(){
        //Admin users CRUD
        Route::get('/getallusers', [UserController::class, 'index'])->name('users.index');
        Route::get('/createuser', [UserController::class, 'create'])->name('users.create');
        Route::post('/adduser', [UserController::class, 'store'])->name('users.store');
        Route::get('/getuser/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('/updateuser/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/deleteuser/{id}', [UserController::class, 'delete'])->name('users.delete');
    });
    
    //Web users CRUD
    Route::get('/getallwebusers', [WebuserController::class, 'index'])->name('webusers.index');
    Route::get('/createwebuser', [WebuserController::class, 'create'])->name('webusers.create');
    Route::post('/addwebuser', [WebuserController::class, 'store'])->name('webusers.store');
    Route::get('/getwebuser/{id}', [WebuserController::class, 'edit'])->name('webusers.edit');
    Route::patch('/updatewebuser/{id}', [WebuserController::class, 'update'])->name('webusers.update');
    Route::get('/deletewebuser/{id}', [WebuserController::class, 'delete'])->name('webusers.delete');

    //Categories according to slugs
    Route::get('/getallcategories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/createcategories', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/addcategory', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/getcategory/{slug}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/updatecategory/{slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/deletecategory/{slug}', [CategoryController::class, 'delete'])->name('categories.delete');

    //Posts according to slugs
    Route::get('/getallposts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/createposts', [PostController::class, 'create'])->name('posts.create');
    Route::post('/addpost', [PostController::class, 'store'])->name('posts.store');
    Route::get('/getpost/{slug}', [PostController::class, 'edit'])->name('posts.edit');
    Route::patch('/updatepost/{slug}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/deletepost/{slug}', [PostController::class, 'delete'])->name('posts.delete');

    Route::middleware('role:Superadmin')->group(function(){
        //Admin Posts according to slugs
        Route::get('/getallpostsadmin', [PostadminController::class, 'index'])->name('postsadmin.index');
        Route::get('/createpostsadmin', [PostadminController::class, 'create'])->name('postsadmin.create');
        Route::post('/addpostadmin', [PostadminController::class, 'store'])->name('postsadmin.store');
        Route::get('/getpostadmin/{slug}', [PostadminController::class, 'edit'])->name('postsadmin.edit');
        Route::patch('/updatepostadmin/{slug}', [PostadminController::class, 'update'])->name('postsadmin.update');
        Route::get('/deletepostadmin/{slug}', [PostadminController::class, 'delete'])->name('postsadmin.delete');
    });

    //Authenticated Admin Posts according to slugs
    Route::get('/getallpostsauth', [PostsAuthController::class, 'index'])->name('postsauth.index');
    Route::get('/createpostsauth', [PostsAuthController::class, 'create'])->name('postsauth.create');
    Route::post('/addpostauth', [PostsAuthController::class, 'store'])->name('postsauth.store');
    Route::get('/getpostauth/{slug}', [PostsAuthController::class, 'edit'])->name('postsauth.edit');
    Route::patch('/updatepostauth/{slug}', [PostsAuthController::class, 'update'])->name('postsauth.update');
    Route::get('/deletepostauth/{slug}', [PostsAuthController::class, 'delete'])->name('postsauth.delete');

    //Polymorphic morph one relation of Profile Image with Users and Webusers
    Route::get('/getallprofileimages', [ProfileImageController::class, 'index'])->name('profileimages.index');
    Route::get('/getprofileimage/{id}', [ProfileImageController::class, 'edit'])->name('profileimages.edit');
    Route::patch('/updateprofileimage/{id}', [ProfileImageController::class, 'update'])->name('profileimages.update');
    Route::get('/deleteprofileimage/{id}', [ProfileImageController::class, 'delete'])->name('profileimages.delete');

    //Polymorphic morph many relation of Prayers with Users and Webusers
    Route::get('/getallprayers', [PrayerController::class, 'index'])->name('prayers.index');
    Route::get('/deleteprayer/{id}', [PrayerController::class, 'delete'])->name('prayers.delete');

    //Events according to ids
    Route::get('/getallevents', [EventController::class, 'index'])->name('events.index');
    Route::get('/createevents', [EventController::class, 'create'])->name('events.create');
    Route::post('/addevent', [EventController::class, 'store'])->name('events.store');
    Route::get('/getevent/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::patch('/updateevent/{id}', [EventController::class, 'update'])->name('events.update');
    Route::get('/deleteevent/{id}', [EventController::class, 'delete'])->name('events.delete');
    Route::get('/allparticipants/{id}',[EventController::class, 'allparticipants'])->name('events.allparticipants');
    Route::get('/removeparticipant/{eventid}/{id}',[EventController::class, 'removeparticipant'])->name('events.removeparticipant');

    //Donation according to ids
    Route::get('/getalldonations', [DonationController::class, 'index'])->name('donations.index');
    Route::get('/createdonations', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/adddonation', [DonationController::class, 'store'])->name('donations.store');
    Route::get('/getdonation/{id}', [DonationController::class, 'edit'])->name('donations.edit');
    Route::patch('/updatedonation/{id}', [DonationController::class, 'update'])->name('donations.update');
    Route::get('/deletedonation/{id}', [DonationController::class, 'delete'])->name('donations.delete');

    //Profile of the authenticated user
    Route::get('/getprofile', [ProfileController::class, 'showprofile'])->name('profile.index');

    Route::middleware('role:Superadmin')->group(function(){
        //Roles for Admin
        Route::get('/getallroles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/createroles', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/addrole', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/getrole/{id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::patch('/updaterole/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::get('/deleterole/{id}', [RoleController::class, 'delete'])->name('roles.delete');

        //Permissions for Admin
        Route::get('/getallpermissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/createpermissions', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/addpermission', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/getpermission/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::patch('/updatepermission/{id}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::get('/deletepermission/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');

        //Assign roles to admin users
        Route::get('/getalluserstoassign', [AssignController::class, 'index'])->name('assign.index');
        Route::get('/getusertoassign/{id}', [AssignController::class, 'edit'])->name('assign.edit');
        Route::patch('/updateusertoassign/{id}', [AssignController::class, 'update'])->name('assign.update');
    });

    //To logout current admin user
    Route::get('/backendlogout', [BackendController::class, 'logout'])->name('backend.logout');
});

//Frontend

//Auth for webusers
Route::get('/signin', [FrontendController::class, 'loginpage'])->name('frontend.signin');
Route::get('/signup', [FrontendController::class, 'registerpage'])->name('frontend.signup');
Route::post('/loginuser', [FrontendController::class, 'login'])->name('frontend.loginuser');
Route::post('/registeruser', [FrontendController::class, 'register'])->name('frontend.registeruser');

//Custom middlware to check Auth of Frontend with Route Grouping
Route::middleware('auth.frontend.check')->group(function(){
    //once authenticated we redirect to homepage
    Route::get('/frontend/home', [FrontendController::class, 'home'])->name('frontend.home');

    //to show polymorphic pray according to slugs
    Route::prefix('posts/')->group(function(){
        Route::get('showall', [FrontendController::class, 'showposts'])->name('frontend.posts');
        Route::get('pray/{slug}', [FrontendController::class, 'pray'])->name('frontend.pray');
    });

    Route::prefix('adminposts/')->group(function(){
        Route::get('showall', [FrontendController::class, 'adminshowposts'])->name('frontend.admin.posts');
        Route::get('pray/{slug}', [FrontendController::class, 'adminpray'])->name('frontend.admin.pray');
    });

    //For events and participation of webusers
    Route::prefix('events/')->group(function(){
        Route::get('showall', [FrontendController::class, 'showevents'])->name('frontend.events');
        Route::get('participate/{id}', [FrontendController::class, 'participate'])->name('frontend.participate');
    });

    //Profile Section
    Route::get('/getwebuserprofile', [ProfileController::class, 'getwebuserprofile'])->name('frontend.profile');

    //For Donations
    Route::get('donations/showall', [FrontendController::class, 'donations'])->name('frontend.donations');

    //For Upload
    Route::get('upload', [FrontendController::class, 'upload'])->name('frontend.upload');
    Route::post('uploadpost', [FrontendController::class, 'uploadpost'])->name('frontend.uploadpost');

    //logout webuser
    Route::get('/frontendlogout', [FrontendController::class, 'logout'])->name('frontend.logout');
});