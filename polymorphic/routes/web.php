<?php

use Illuminate\Support\Facades\Route;
use App\Models\Staff;

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

Route::get('create', function(){
    // User::create(['name'=> 'Peace Ariyo', 'email'=>'bunmipeace@yahoo.com', 'password'=>bcrypt('priest')]);
    $staff = Staff::findorfail(1);
    $staff->photos()->create(['path'=>'niceFlowers.jpg']);

});
// reading a polymorphic relationship
Route::get('/read', function(){
    $staff = Staff::findorfail(1)->photos;
    return $staff;
});
Route::get('/read2', function(){
    $staff = Staff::findorfail(1)->photos;
    foreach ($staff as $photo) {
        # code...
        echo $photo->path.'<br >';
    }
});
Route::get('/read3', function(){
    $staff = Staff::findOrFail(1)->photos()->get()->whereNotNull('delete_at');
    foreach ($staff as $staff) {
        # code...
        echo $staff;
        echo "This has been deleted";
        // if($staff== )
    }
});

// first() returns an object
// get() returns a collection
// update using the polymorphic relationship
Route::get('/update', function(){
    $staff = Staff::findOrFail(1)->photos()->whereId(1)->update(['path'=>'examples.png']);
});

// Delete 
Route::get('/delete', function(){
    $staff = Staff::findOrFail(1)->photos()->first();
    $staff->delete();
});
