<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BarangController extends Controller
{
    public function viewcreatebarang(){
        return view('home');
    }
    
    public function createbarang(request $request){

        $request->validate([
            'fotobarang' => 'mimes:jpg, jpeg, png'
        ]);

        if($request->hasFile('fotobarang')){
            $image_path = 'public/fotobarang';
            $image = $request->file('fotobarang');
            $image_name = str::random(5).'_'.$image->getClientOriginalName();
            $image->storeAs($image_path, $image_name);
            //$path = $request->file('fotobarang')->storeAs($image_path, $image_name);
        }

        barang::create([
            'kategoribarang' => $request->kategoribarang,
            'namabarang' => $request->namabarang,
            'hargabarang'=> $request->hargabarang,
            'jumlahbarang'=> $request->jumlahbarang,
            'fotobarang'=> $image_name,
        ]);
        return redirect('viewadmin');
    }

    public function view(){
        $thing = barang::all();
        return view('viewuser')->with('semuabarang', $thing);
    }

    public function viewadmin(){
        $thing = barang::all();
        return view('/viewadmin')->with('semuabarang', $thing);
    }

    public function editform($id){
        $thing = barang::findOrFail($id);
        return view('edit')->with('semuabarang', $thing);
    }

    public function edit($id, Request $request){
        $thing = barang::findOrFail($id);

        $request->validate([
            'fotobarang' => 'mimes:jpg, jpeg, png'
        ]);

        if($request->hasFile('fotobarang')){
            $image_path = 'public/fotobarang';
            Storage::delete($image_path.$thing);

            $image = $request->file('fotobarang');
            $image_name = str::random(5).'_'.$image->getClientOriginalName();
            $image->storeAs($image_path, $image_name);
        }

        $thing->update([
            'kategoribarang' => $request->kategoribarang,
            'namabarang' => $request->namabarang,
            'hargabarang'=> $request->hargabarang,
            'jumlahbarang'=> $request->jumlahbarang,
            'fotobarang' => $image_name,
        ]);
        return redirect('viewadmin');
    }

    public function delete($id){
        barang::destroy($id);

        return redirect('viewadmin');
    }
}