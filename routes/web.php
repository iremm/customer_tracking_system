<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
Route::get('/', function () {
    return view('login');
});

Route::controller(UserController::class)->group(function(){
    Route::post('user/login-form','login');
    Route::post('admin/login-form','login');
});