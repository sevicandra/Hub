<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kinerjaOrganisasi;

class chart extends Controller
{
    public function NKO(Request $request){
        $NKO = kinerjaOrganisasi::orderBy('kodeIKU')->where('tahun', $request->tahun)->get();
        $i=0;
        foreach ($NKO as $data){
            $namaIKU[]=$data->namaIKU;
            if ($data->capaianlast) {
                $capaian[]=$data->capaianlast->capaian;
            }else{
                $capaian[]=0;
            }

            if ($data->targetlast) {
                $target[]=$data->targetlast->target;
            }else{
                $target[]=0;
            }
            if ($data->polarisasi === 'MAX') {
                if (($capaian[$i]/$target[$i]) > 1.2) {
                    $realisasi[]=120;
                }else{
                    $realisasi[]=($capaian[$i]/$target[$i])*100;
                }
            }elseif($data->polarisasi === 'MIN'){
                if((1+(1-($capaian[$i]/$target[$i]))) > 1.2){
                    $realisasi[]=120;    
                }else{
                    $realisasi[]=(1+(1-($capaian[$i]/$target[$i])))*100;
                }
            }
            $i++;
        }
        $response['namaIKU']=$namaIKU;
        $response['capaian']=$realisasi;
        
        return json_encode($response);
    }
}
