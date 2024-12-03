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
    
    $customers = Customers::all();

      return view('homepage-admin',['customers' => $customers]);
    }
    //customer-page
    public function customer_home(){
        
        $customers = Customers::all();
        
        return view('homepage-customer',['customers' => $customers]);
    }
    //save_customer
    public function save_customer(Request $request){
          $changes = $request->input('changes');

          foreach ($changes as $change) {
              $customer = Customers::find($change['id']);
  
              if ($customer) {
                  $customer->{$change['field']} = $change['value'];
                  $customer->save();
              }
          }
  
          return response()->json(['message' => 'Değişiklikler başarıyla kaydedildi!']);
    }
}