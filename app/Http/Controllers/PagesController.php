<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends controller
{

    public function admin_home(){

      return view('homepage-admin');
    }

}