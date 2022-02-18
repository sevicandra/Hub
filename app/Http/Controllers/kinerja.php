<?php

namespace App\Http\Controllers;

use App\Models\capaian;
use App\Models\targetRaw;
use App\Models\capaianRaw;
use Illuminate\Http\Request;
use App\Models\targetPersentase;

class kinerja extends Controller
{
    public function inputTarget(Request $request){
        $ValidatedData = $request->validate([
            "idikator_kinerja_utama_id"=>'required',
            "targetQ1"=>'nullable',
            "targetQ2"=>'nullable',
            "targetQ3"=>'nullable',
            "targetQ4"=>'nullable',
        ]);
        $ValidatedData2 = $request->validate([
            "idikator_kinerja_utama_id"=>'required',
            "targetRawQ1"=>'nullable',
            "targetRawQ2"=>'nullable',
            "targetRawQ3"=>'nullable',
            "targetRawQ4"=>'nullable',
        ]);
        targetPersentase::create($ValidatedData);
        targetRaw::create($ValidatedData2);
    }

    public function updateTarget(Request $request){
        $ValidatedData = $request->validate([
            "target_persentase_id"=>'required',
            "targetQ1"=>'nullable',
            "targetQ2"=>'nullable',
            "targetQ3"=>'nullable',
            "targetQ4"=>'nullable',
        ]);
        $ValidatedData2 = $request->validate([
            "target_raw_id"=>'required',
            "targetRawQ1"=>'nullable',
            "targetRawQ2"=>'nullable',
            "targetRawQ3"=>'nullable',
            "targetRawQ4"=>'nullable',
        ]);
        targetPersentase::find($ValidatedData['target_persentase_id'])->update([
            "targetQ1"=>$ValidatedData['targetQ1'],
            "targetQ2"=>$ValidatedData['targetQ2'],
            "targetQ3"=>$ValidatedData['targetQ3'],
            "targetQ4"=>$ValidatedData['targetQ4'],
        ]);
        targetRaw::find($ValidatedData2['target_raw_id'])->update([
            "targetRawQ1"=>$ValidatedData2['targetRawQ1'],
            "targetRawQ2"=>$ValidatedData2['targetRawQ2'],
            "targetRawQ3"=>$ValidatedData2['targetRawQ3'],
            "targetRawQ4"=>$ValidatedData2['targetRawQ4'],
        ]);
    }

    public function inputCapaian(Request $request){
        
        $ValidatedData=$request->validate([
            'target_persentase_id'=>'required',
            'bulan'=>'required',
            'persentase'=>'nullable'
        ]);
        $ValidatedData2=$request->validate([
            'target_raw_id'=>'required',
            'bulan'=>'required',
            'raw'=>'nullable'
        ]);
        $ValidatedData['capaian']=$ValidatedData['persentase'];
        $ValidatedData2['capaian']=$ValidatedData2['raw'];
        capaian::create($ValidatedData);
        capaianRaw::create($ValidatedData2);

    }

}
