<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// create users
Route::get('/users', function(){
    User::create(['name'=>'Peace Ariyo', "email"=>"bunmipeace@yahoo.com", "password"=> bcrypt('qwerty')]);
    return "User successfully created";
});

// create roles for users
Route::get('/roles', function(){
    $user = User::find(1);
    $roles = new Role(['name'=>'Actors']);
    $user->roles()->save($roles);
});

// read user roles
Route::get('/read', function(){
    $user = User::findorfail(1)->roles;
    foreach ($user as $role) {
        # code...
        echo $role->name;
        // dd($user);
    };
});

// update user's role
Route::get('/update', function(){
    $user = User::findorfail(1)->roles()->whereUserId(1)->update(['name'=>"Supervisor"]);
    return;
});

// update method 2
// something is wrong with this function
Route::get('/update2', function(){
    $user = User::findorfail(1)->roles()->whereUserId(1);
    $user->name = "Administrator";
    $user->save();
});

// update method 3
Route::get('/update3', function(){
    $user = User::findorfail(1);
    if ($user->has('roles')) {
        # code...
        foreach ($user->roles as $role) {
            # code...
            if ($role->name == 'Administrator'){
                $role->name = 'Supervisor';
                $role->save();
                echo $role;
            }
        }
    };
});

// Delete method
Route::get('/delete', function(){
    $users = User::findorfail(1)->roles;
    foreach ($users as $user) {
        # code...
        $user->where('name', 'Actors')->delete();
    }
});

// assigning roles to user using the attach method
// regardless if it already exist or not
Route::get('/attach', function(){
    $users = User::findOrFail(1);
    $users->roles()->attach(2);
});

// detach roles from user
Route::get('/detach', function(){
    $users = User::findOrFail(1);
    $users->roles()->detach(2);
});

// synchronize roles
Route::get('/sync', function(){
    $users = User::findOrFail(1);
    $users->roles()->sync([]);
});
