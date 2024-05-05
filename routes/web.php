<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Models\barang;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function(){
    //Route::get('/viewadmin',[BarangController::class, 'viewadmin'])->name('view');
    Route::controller(BarangController::class)->group(function(){
        Route::get('/viewuser','view')->name('viewall');
    });

    Route::controller(BarangController::class)->group(function(){
        Route::get('/viewadmin','viewadmin')->name('viewadmin');
    });

    Route::controller(CartController::class)->group(function(){
    });

    Route::controller(OrderController::class)->group(function(){
    Route::get('/editorder/{id}','vieweditorder')->name('vieweditorder');
    Route::post('/barangorder','createorder')->name('createorder');
    Route::delete('/delete/{id}', 'deleteorder')->name('deleteorder');
    Route::get('/viewcart','viewcart')->name('viewcart');
    });

    Route::controller((AddressController::class))->group(function(){
        Route::post('/createalamat','createalamat')->name('createalamat');
        Route::get('/invoice','invoice')->name('invoice');
        Route::delete('/deleteh/{id}', 'deleteh')->name('deleteh');
    });

    Route::prefix('admin')->middleware(['isAdmin'])->group(function(){
    Route::controller(BarangController::class)->group(function(){
        Route::get('/home','viewcreatebarang')->name('viewbarang');
        Route::post('/barangcreated','createbarang')->name('create');
        Route::get('/editbarang/{id}', 'editform')->name('editform');
        Route::patch('/edited/{id}', 'edit')->name('edited');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });
    });
});

Route::get('/', function () {
    return view('welcome');
});


Route::controller(UserController::class)->group(function(){
    Route::get('/register-form', 'registerform')->name('register');
    Route::post('/registered', 'create')->name('registered');
    Route::get('/login', 'login')->name('login');
    Route::post('/logedin', 'logedin')->name('logedin');
    Route::post('/Logout', 'Logout')->name('Logout');
    });




// Route::controller(BarangController::class)->group(function(){
//     Route::get('/viewuser','view')->name('viewall');
//     Route::get('/home','viewcreatebarang')->name('viewbarang');
//     Route::post('/barangcreated','createbarang')->name('create');
//     Route::get('/viewadmin','viewadmin')->name('viewall');
//     Route::get('/editbarang/{id}', 'editform')->name('editform');
//     Route::patch('/edited/{id}', 'edit')->name('edited');
//     Route::delete('/delete/{id}', 'delete')->name('delete');
// });