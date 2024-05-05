<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CartController extends Controller
{
    // public function viewcart(){
    //     $thing= Order::all();
    //     return view('/viewcart')->with('semuabarang', $thing);
    // }
}
