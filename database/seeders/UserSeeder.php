<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeders;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Authenticatable
{
   public function run(){
    //admin user
    User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin'
    ]); 
    //customer user
    User::create([
        'name' => 'Staff',
        'email' => 'staff@example.com',
        'password' => Hash::make('password'),
        'role' => 'staff'
    ]); 
   }

}
