<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Provinsi;

class ProvinsiController extends Controller
{
    public function index()
    {
        $Provinsi = Provinsi::all();
        return response()->json($Provinsi);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "key" => "required",
            "value" => "required",
            "file" => "required|image"
        ]);
        $data = $request->all();
       
        $provinsi = Provinsi::create($data);

        return response()->json($provinsi);
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
        $this->validate($request, [
            "key" => "required",
            "value" => "required",
            "file" => "required|image"
        ]);
        
        $data = $request->all();
        $Provinsi->fill($data);
        $Provinsi->save();

        return response()->json($Provinsi);
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