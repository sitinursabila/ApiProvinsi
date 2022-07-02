<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Provinsi;
//use Illuminate\Support\Facades\Storage;

class ProvinsiController extends Controller
{
    public function index()
    {
        $Provinsi = Provinsi::all();
        return response()->json($Provinsi);
    }

    public function create(Request $request)
    {
         
    $allowedfileExtension=['pdf','jpg','png'];
 
     $extension =  $request->file('file')->getClientOriginalExtension();

    // $request->file('file')->move('upload',$file);
   // return response()->json($gambar);
      
     $mediaFiles=$request->file('file')  ;
      $check = in_array($extension,$allowedfileExtension);
      $this->validate($request, [
        "key" => "required",
                  "value" => "required"
      //  "file" =>  'required|mimes:png,jpg,jpeg,gif|max:2048'
    ]);
        if($check) {
              
                $name = $mediaFiles->getClientOriginalName();
                $request->file('file')->move('upload',$name);
                $data 
                = array(
                    "key"=> $request->input('key'),
                    "value"=> $request->input('value'),
                    "file"=> $name
                );
                $provinsi = Provinsi::create($data);
                return response()->json($data);

        } else {
            return response()->json(['invalid_file_format'], 422);
        }
     
       
     }
    
    public function show($id)
    {
        $Provinsi = Provinsi::find($id);
        return response()->json($Provinsi);
    }
    public function update(Request $request, $id)
    {
        $Provinsi = Provinsi::find($id);
        
        if (!$Provinsi) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        
        $data = $request->all();
        $Provinsi->fill($data);
        
        $Provinsi->save();
        $data1 = [
            'status'=> true,
            'message'=>"data Json di update",
            'data'=> $data
        ];
var_dump($request->all());
die;
        return response()->json($data1);
    }

    public function destroy($id)
    {
        $Provinsi = Provinsi::find($id);
        
        if (!$Provinsi) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $Provinsi->delete();

        return response()->json(['message' => 'Data deleted successfully'], 200);
    }
} 