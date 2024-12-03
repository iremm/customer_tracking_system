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
  
          return response()->json([
            'status' => 'success',
            'message' => "Customers changed"
        ]);
    }

    //delete customer
    public function delete_customer(Request $request){
        $customer = Customers::find($request->id)->first();

      
            if ($customer) {

                $customer->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => "Customer Deleted"
                ]);
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => "Customer Deleted Failed"
                ]);
            }

  }
    //add customer
    public function add_customer(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'surname' => 'required|string|max:255',
        'email' => 'required|email|unique:customers,email',
        'phone' => 'required|string|max:20',
        'company_name' => 'required|string|max:255',
    ]);

        $customer = new Customers();
        $customer->name = $validatedData['name'];
        $customer->surname = $validatedData['surname'];
        $customer->email = $validatedData['email'];
        $customer->phone = $validatedData['phone'];
        $customer->company_name = $validatedData['company_name'];

        return response()->json([
            'status' => 'success',
            'message' => 'Kullanıcı başarıyla eklendi.',
            'data' => $customer
        ]);
}

}