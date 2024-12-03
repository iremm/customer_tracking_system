<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customers;
use PhpOffice\PhpSpreadsheet\IOFactory;

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

    //add excel
  

 

    public function upload_excel(Request $request)
    {
        $request->validate([
            'excelFile' => 'required|file|mimes:xlsx',
        ]);
        
        $file = $request->file('excelFile');
        $path = $file->getRealPath();
        
        // Zip dosyasını açma
        $zip = new \ZipArchive;
        if ($zip->open($path) === TRUE) {
            $xmlContent = '';
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileName = $zip->getNameIndex($i);
                if (strpos($fileName, 'sheet') !== false) {
                    $xmlContent = $zip->getFromName($fileName);
                    break;
                }
            }
            
            if ($xmlContent) {
                $xml = simplexml_load_string($xmlContent);
                $namespaces = $xml->getNamespaces(true);
    
                $rows = [];
                foreach ($xml->sheetData->row as $row) {
                    $rowData = [];
                    foreach ($row->c as $cell) {
                        $cellValue = (string) $cell->v;
                        $rowData[] = $cellValue;
                    }
                    $rows[] = $rowData;
                }
    
                foreach ($rows as $row) {
                    $customer = new Customers();
                    $customer->name = $row[0];
                    $customer->surname = $row[1];
                    $customer->email = $row[2];
                    $customer->phone = $row[3];
                    $customer->company_name = $row[4];
                    $customer->save();

                    

                }
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'Excel dosyasındaki içerik başarıyla kaydedildi.',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Excel dosyasındaki veri alınamadı.',
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Excel dosyası açılamadı.',
            ]);
        }
    }
    
    
}