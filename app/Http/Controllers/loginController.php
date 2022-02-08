<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class loginController extends Controller
{
    public function login(Request $request){
        $credentials =$request->validate([
            'NIP'=>'required|min:18|max:18',
            'password'=>'required',
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            $request->session()->put('tahun', $request->tahun);
            return redirect()->intended('/home');
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
