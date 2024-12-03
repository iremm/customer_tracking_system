<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customers;
class PagesController extends controller
{
    //admin-page
    public function admin_home(){
    
    $admin = Customers::all();
      return view('homepage-admin',['admin' => $admin]);
    }
    //customer-page
    public function customer_home(){
        
        $customers = Customers::all();
        
        return view('homepage-customer',['customers' => $customers]);
      }
}