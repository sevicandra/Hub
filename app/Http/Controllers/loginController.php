<?php

namespace App\Http\Controllers;
use App\Models\pnbp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

        return back()->with('LoginErorr','LoginFailed');
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
        $PKN = pnbp::where('tahun', $request->session()->get('tahun'))->where('jenis', 'PKN')->first();
        $LLG = pnbp::where('tahun', $request->session()->get('tahun'))->where('jenis', 'LLG')->first();
        $PPN = pnbp::where('tahun', $request->session()->get('tahun'))->where('jenis', 'PPN')->first();

        if ($PKN) {
            $capaianPKN = $PKN->capaian()->get()->sortBy('bulan');
        }else{
            $capaianPKN=[];
        }

        if ($LLG) {
            $capaianLLG = $LLG->capaian()->get()->sortBy('bulan');
        }else{
            $capaianLLG=[];
        }

        if ($PPN) {
            $capaianPPN = $PPN->capaian()->get()->sortBy('bulan');
        }else{
            $capaianPPN=[];
        }


        return view('home', [
            'PNBPPKN' => $PKN,
            'capaianPKN' => $capaianPKN,
            'PNBPLLG' => $LLG,
            'capaianLLG' => $capaianLLG,
            'PNBPPPN' => $PPN,
            'capaianPPN' => $capaianPPN,
        ]);
    }
}
