<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends controller
{

    public function login(Request $request){
        if($request->role == 1){
            dd("1");
        }
        else{
            dd("2");
        }
    }

}