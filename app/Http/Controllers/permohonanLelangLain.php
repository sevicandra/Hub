<?php

namespace App\Http\Controllers;

use App\Models\tiket;
use App\Models\lotLelang;
use Illuminate\Http\Request;
use App\Models\pemohonLelang;
use App\Models\permohonanLelang;
use Illuminate\Support\Facades\Redirect;

class permohonanLelangLain extends Controller
{
    public function index(){
        return view('pindai.PermohonanLelangLain',[
            'data'=>permohonanLelang::all(),
            'permohonanLelangview'=>'',
            'title'=> 'TERNATE-HUB || PINDAI',
            'favicon'=>'/img/ico/pindai.png'
        ]);

    }

    public function store(Request $request){
        $request->validate([
            'nomorSurat'=>'required',
            'hal'=>'required',
            'tanggalSurat'=>'required',
            'tanggalDiTerima'=>'required',
            'pemohon'=>'required',
            'kontakPemohon'=>'required',
            'PIC'=>'required'
        ]);
    
        $tiket_id=tiket::count();
        $tiket_id++;
        $tiket='LLG';
        if ($tiket_id < 10) {
            $tiket .= '0000';
        }elseif ($tiket_id < 100) {
            $tiket .= '000';
        }elseif ($tiket_id < 1000) {
            $tiket .= '000';
        }elseif ($tiket_id < 10000) {
            $tiket .= '00';
        }elseif ($tiket_id < 100000) {
            $tiket .= '0';
        }elseif ($tiket_id >= 100000) {
            $tiket .= '';
        }
        $tiket .= $tiket_id; 
        $tiketbaru = tiket::create([
            'tiket'=>$tiket,
            'lelang'=>1,
            'jenis'=>'LLG'
        ]);
        
        $permohonanLelang = permohonanLelang::create([
            'nomorSurat'=> $request->nomorSurat,
            'hal'=> $request->hal,
            'tanggalSurat'=> $request->tanggalSurat,
            'tanggalDiTerima'=> $request->tanggalDiTerima,
            'jenis'=> 'App\Models\tiket',
            'surat_persetujuan_id'=>$tiketbaru->id,
        ]);

        pemohonLelang::create([
            'permohonan_lelang_id'=>$permohonanLelang->id,
            'pemohon'=>$request->pemohon,
            'PIC'=> $request->PIC,
            'kontakPemohon'=>$request->kontakPemohon,
        ]);

        return Redirect::back();

    }

    public function destroy(permohonanLelang $permohonanlelang){
        if (!$permohonanlelang->penetapanLelang) {
            $permohonanlelang->suratPersetujuan->Update(['lelang'=> 0]);
            $permohonanlelang->pemohonLelang->delete();
            $permohonanlelang->lotLelang()->delete();
            $permohonanlelang->delete();
            return Redirect::back();
            
        }else{
            abort(403);
        }
    }

    public function storeLot(Request $request){
        // return $request;
        if (!permohonanLelang::find($request->permohonan_lelang_id)->penetapanLelang) {
            $i=0;
            foreach ($request->lot as $key) {
                lotLelang::create([
                    'namaLot'=>$request->lot[$i],
                    'limit'=>$request->nilai[$i],
                    'permohonan_lelang_id'=>$request->permohonan_lelang_id
                ]);
                $i++;
            }
            return Redirect::back();
        }else{
            abort(403);
        }
    }
    public function destroyLot(lotLelang $lotLelang){
        if (!$lotLelang->permohonanLelang->penetepanLelang) {
            $lotLelang->delete();
            return json_encode(['status'=>'success']);
        }else{
            return json_encode(['status'=>'denied']);
        }
    }
}
