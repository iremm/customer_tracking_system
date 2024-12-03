<?php

namespace Database\Seeders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeders;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
   public function run(){
    //admin user
    $admin = User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin'
    ]); 
    //customer user
    $staff = User::create([
        'name' => 'Staff',
        'email' => 'staff@example.com',
        'password' => Hash::make('password'),
        'role' => 'staff'
    ]); 

    $adminRole = Role::where('name','admin')->first();
    $staffRole = Role::where('name','staff')->first();

    $admin->roles()->attach($adminRole);
    $staff->roles()->attach($staffRole);
   }

}
