<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get(uri:'/home',action: [App\Http\Controllers\HomeController::class, 'index'])->name(name:'home');

// Route::get('home2',function(){
//     return "hello world";
// });
Route::resource(name:'users',controller:UserController::class);
// Route::get('users',[UserController::class,'index']);