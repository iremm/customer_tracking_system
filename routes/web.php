<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Middleware\CheckLogin;
Route::get('/', function () {
    return view('login');
});

Route::controller(UserController::class)->group(function(){
    Route::post('user/login-form','login');
    Route::post('admin/login-form','login');
});

Route::controller(PagesController::class)->group(function(){
    Route::post('save-changes','save_customer');
    Route::post('/delete-customer','delete_customer');
    Route::post('/add-user','add_customer');
    Route::post('/upload-excel','upload_excel');
    
});
Route::controller(PagesController::class)->middleware([CheckLogin::class.':admin'])->group(function() {
    Route::get('admin/mainpage', 'admin_home');
    Route::get('customer/mainpage', 'customer_home');
});


