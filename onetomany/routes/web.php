<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Post;

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

// creating users
Route::get('insert-user', function(){
    User::create(['name'=> "Peace Ariyo", 'email'=>"bunmipeace@yahoo.com", 'password'=>bcrypt('qwerty')]);
    echo "user inserted successfully";
});

// Create posts
Route::get('insert-posts', function(){
    $user = User::findorfail(1);
    $posts = Post::create(['title'=>"dgdhchegd", 'body'=>"djcnkejjdwjehsbdhnsdchsdncshdjdshcb"]);
    $user->posts()->save($posts);
});

// Read all posts belonging to user
Route::get('/read-posts', function(){
    $user = User::findorfail(1)->posts;
    foreach ($user as $use) {
        # code...
        echo $use->title;
        echo '<br />';
    }
    // return $user;
});

// updating particular post belonging to user
Route::get('update', function(){
  $user = User::findorfail(1)->posts()->whereTitle('music')->update(['body'=>'I love talking about musical dexterity']);
  return $user;
});

// Delete post relating to user

Route::get('/delete', function(){
    $user = User::findorfail(1)->posts()->whereId(4)->delete();
});