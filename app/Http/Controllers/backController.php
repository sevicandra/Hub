<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

}
