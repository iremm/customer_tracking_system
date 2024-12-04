<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends controller
{

    public function login(Request $request){

        $user = User::where('email',$request->email)->first();
        if($user && Hash::check($request->password,$user->password)){
            if($request->role == 1){
                Auth::login($user);
                return response()->json([
                    'status' => 'success',
                    'role' => 1,
                    'message' => "Success Login"
                ]);
            }
            else{
                Auth::login($user);
                return response()->json([
                    'status' => 'success',
                    'role' => 2,
                    'message' => "Success Login"
                ]);
            }
        }
        else{
                return response()->json([
                    'status' => 'error',
                    'role' => 2,
                    'message' => "Success Login"
                ]);
        }
       
    }

}