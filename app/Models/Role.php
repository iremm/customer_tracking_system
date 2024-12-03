<?php

namespace App\Models;
use App\Models\User;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use HasFactory;

   public function users(){
    return $this->belongsToMany(User::class);
   }
}
