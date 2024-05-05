<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderController extends Controller
{


    public function vieweditorder($id){
        $thing = barang::findOrFail($id);
        return view('editorder')->with('semuabarang', $thing);
    }

    public function createorder(request $request){

        Order::create([
            'kategoriorder' => $request->kategoriorder,
            'namaorder' => $request->namaorder,
            'hargaorder'=> $request->hargaorder,
            'jumlahorder'=> $request->jumlahorder
        ]);
        return redirect('viewuser');
    }

    public function deleteorder($id){
        Order::destroy($id);

        return redirect('/viewcart');
    }

    public function viewcart(){
        $thing= Order::all();
        return view('/viewcart')->with('semuabarang', $thing);
    }
}
