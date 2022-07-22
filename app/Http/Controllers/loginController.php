<?php

namespace App\Http\Controllers;
use App\Models\pnbp;
use Illuminate\Http\Request;
use App\Models\suratPersetujuan;
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
        $PKN = pnbp::where('tahun', $data)->where('jenis', 'PKN')->first();
        $LLG = pnbp::where('tahun', $data)->where('jenis', 'LLG')->first();
        $PPN = pnbp::where('tahun', $data)->where('jenis', 'PPN')->first();

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
        $persetujuan=[];
        $limit=[];
        foreach (suratPersetujuan::all() as $key ) {
            if ($key->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->barang->avg('status')<2){
                if (date('Y-m-d', strtotime($key->tanggalSurat. ' + 6     months')) >  date('Y-m-d')) {
                    $persetujuan[]=$key;
                    $limit[]=$key->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->barang->where('status', '<', 2)->sum('nilaiLimit');
                }
            }
        }
        // return $limit;
        $potensiLelang=['persetujuan'=>$persetujuan, 'limit'=>$limit];
        return view('home', [
            'PNBPPKN' => $PKN,
            'capaianPKN' => $capaianPKN,
            'PNBPLLG' => $LLG,
            'capaianLLG' => $capaianLLG,
            'PNBPPPN' => $PPN,
            'capaianPPN' => $capaianPPN,
            'persetujuan'=>$persetujuan,
            'limit'=>$limit
        ]);
    }
}
