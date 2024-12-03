<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
Route::get('/', function () {
    return view('login');
});

Route::controller(UserController::class)->group(function(){
    Route::post('user/login-form','login');
    Route::post('admin/login-form','login');
});

Route::controller(PagesController::class)->group(function(){
    Route::post('customer/mainpage','customer_home');
    Route::post('admin/mainpage','admin_home');
});