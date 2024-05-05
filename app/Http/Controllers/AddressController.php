<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Order;
use app\Http\Controllers\BarangController;

class AddressController extends Controller
{
    public function invoice(){
        $address = Address::all();
        $thing = Order::all();
        return view('invoice')->with('Alamat', $address)->with('semuabarang', $thing);
    } 

    public function createalamat(request $request){

        Address::create([
            'alamat' => $request->alamat,
            'kodepos' => $request->kodepos
        ]);
        return redirect('invoice');
    }

    public function deleteh($id){
        Address::destroy($id);
        //Order::truncate();

        return redirect('viewadmin');
    }
}
