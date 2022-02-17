<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\barang;
use Illuminate\Http\Request;
use App\Models\penyampaianLaporan;
use App\Models\permohonanPenilaian;

class backController extends Controller
{
    public function anggotaTimPenilai(permohonanPenilaian $timpenilai){
        return json_encode($timpenilai->users);
    }

    public function listTim(){
        $a = User::orderBy('NIP', 'asc')->get();
        return json_encode($a); 
    }

    public function hapusanggota(Request $request){

        $a = permohonanPenilaian::all()->find($request->permohonanPenilaian_id);
        $a->users()->detach($request->user_id);
        
        return json_encode($a->users);
    }

    public function nilaiLimit(Request $request){
        $penyampaianLaporan = penyampaianLaporan::all()->find($request->penyampaian_laporan_id);

        return json_encode($penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->barang);
    }

    public function penetapanLimit(Request $request){
        $i=0;
        foreach ($request->barang_id as $key) {
            barang::where('id', $key)->update([
                'nilaiLimit'=> $request->nilaiLimit[$i],
            ]);
            $i++;
        }
        return redirect('/persetujuan');
    }
}
