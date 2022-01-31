<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class loginController extends Controller
{
    public function login(Request $reguest){
        $credentials =$reguest->validate([
            'NIP'=>'required|min:18|max:18',
            'password'=>'required',
        ]);
        if(Auth::attempt($credentials)){
            $reguest->session()->regenerate();
            $reguest->session()->put('tahun', $reguest->tahun);
            return redirect()->intended('/Home');
        }
        return back()->With('LoginErorr','LoginFaile');
    }
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->intended('/login');
    }

    public function home(Request $request)
    {
        $data = $request->session()->get('tahun');
        return view('home', [
            'data' => $data 
        ]);
    }
}
