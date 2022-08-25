<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; 

use App\Models\Address;
use App\Models\User;

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

Route::get('/insert', function () {
    /* User::create(['name'=>"Peace Ariyo", 'email' => "bunmipeace@yahoo.com", "password"=> "qwerty"]);
    echo "successful insertion"; */

    /* $user = User::find(1);
    $address = Address::create(['name'=>'Lagos']);
    $user->address()->save($address); */
    

    $user = User::findorfail(1);   
    $address = new Address(['name'=>'Ikosi-Ketu, Lagos, Nigeria.']);
    $user->address()->save($address);

    static $user_called = false;
    if ($user_called) return;

    $user_called = true;
   
});

Route::get('/update-address/{id}', function($id){
    // $address = Address::findorfail($id);
    $address = Address::whereUserId($id)->first();
    $address->name = 'Dawaki, Gwarinpa area, Abuja';
    $address->save();
    echo "update is successful";
});

Route::get('/read', function(){
    // $address =  Address::find(1)->get();
    // $address =  User::all();
    $address =  User::findorfail(1);
    return $address->address->name;
});

Route::get('/delete', function(){
    // $user= Address::findorfail(1)->delete();
    // echo "delete successful";

    $user = User::findorfail();
    $user->address()->delete() ;// call address method if a method will be chained on it
});
