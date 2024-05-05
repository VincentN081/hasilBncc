<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\barang;
use Illuminate\Support\Facades\Validator;

class BarangControllerApi extends Controller
{
    public function index(){
        $thing = barang::all();

        return response($thing, 200)->json([
            "barang" => $thing
        ], 200);
    }

    public function create(Request $request){
        $validate = Validator::make($request->all(), [
            'namabarang' => 'required | min:5'
        ]);

        if($validate->fails()){
            return response($validate->messages(), 422);
        }else{
            $book = barang::create([
                'kategoribarang' => $request->kategoribarang,
                'namabarang' => $request->namabarang,
                'hargabarang'=> $request->hargabarang,
                'jumlahbarang'=> $request->jumlahbarang,
                'fotobarang'=> $request->fotobarang,
            ]);
    
            return response()->json([
                "barang" => $book
            ], 200);
        }
    }
}
