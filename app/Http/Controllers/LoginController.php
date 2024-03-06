<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PHPFlahser\Flasher;


use Illuminate\Http\Request;

class LoginController extends Controller
{
    
    public function register (){
        return view("register");

    }

    public function registration(Request $request){
        $validatedData = $request->validate([
            'nama'  => ['required'],
            'username' => ['required','unique:users'],
            'password' => ['required'],
            'role'  => ['required'],
        ]);

        $validatedData['password'] = bcrypt($request->password);
        
        User::create($validatedData);
        
        return redirect('/login');
    }

    
    public function login(){
        return view("login");
    
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],

        ]);

        //validasi user
    if (Auth::attempt($credentials)){
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    return back()->withErrors(['LoginFailed' => 'Username atau Password salah'
    ]);
    
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        
        return redirect('/login'); 
    }

}