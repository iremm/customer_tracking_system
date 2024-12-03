<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends controller
{
    //admin-page
    public function admin_home(){

      return view('homepage-admin');
    }
    //customer-page
    public function customer_home(){

        return view('homepage-customer');
      }
}