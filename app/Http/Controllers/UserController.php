<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function registerform(){
        return view('register');
    }

    public function create(Request $request){
        $request->validate([
            'nama'=> 'required | min:3  | max:40',
            'email' => 'required | regex:/(.*)@gmail\.com/',
            'password' => 'required | min:6 | max:12',
            'nomorhp'  => 'required'
        ]);

        User::create([
            'nama' => $request->nama,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'nomorhp'=> $request->nomorhp,
        ]);
        return redirect('/')->with('success','user registered');
    }

    public function login(){
        return view('/viewuser');
    }

    public function logedin(Request $request){
        
        $user = User::where('email','=', $request->email)->first();
        if($user && Hash::check($request->password, $user->password)){
            Auth::login($user);
            if(Auth::check()){
                return redirect('/viewuser');
            }else{
                return redirect('/');     
            }
        }else{
            return back()->withErrors([
                'email' => 'Wrong Info Please Try Again',
            ]);
        }
    }

    public function Logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
