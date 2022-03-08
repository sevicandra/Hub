<?php

namespace App\Http\Controllers;

use App\Models\pnbp;
use Illuminate\Http\Request;
use App\Models\kinerjaOrganisasi;

class chart extends Controller
{
    public function NKO(Request $request){
        $NKO = kinerjaOrganisasi::orderBy('kodeIKU')->where('tahun', $request->tahun)->get();
        if ($NKO->first()) {
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
                }else{
                    $target[]=null;
                    $realisasi[]=0;
                }
                
                $i++;
            }
            $response['namaIKU']=$namaIKU;
            $response['capaian']=$realisasi;
            return json_encode($response);
        }else{
            $response['namaIKU']=[];
            $response['capaian']=[];
            return json_encode($response);
        }
        
    }

    public function PNBPPKN(Request $request){
        $PKN = pnbp::where('tahun', $request->session()->get('tahun'))->where('jenis', 'PKN')->first();
        if ($PKN) {
            $capaian=$PKN->capaian()->get()->sortBy('bulan');
        }else{
            $capaian=[];
        }
        return json_encode($capaian);
    }

    public function PNBPLLG(Request $request){
        $LLG = pnbp::where('tahun', $request->session()->get('tahun'))->where('jenis', 'LLG')->first();
        if ($LLG) {
            $capaian=$LLG->capaian()->get()->sortBy('bulan');
        }else{
            $capaian=[];
        }
        return json_encode($capaian);
    }

    public function PNBPPPN(Request $request){
        $PPN = pnbp::where('tahun', $request->session()->get('tahun'))->where('jenis', 'PPN')->first();
        if ($PPN) {
            $capaian=$PPN->capaian()->get()->sortBy('bulan');
        }else{
            $capaian=[];
        }
        return json_encode($capaian);
    }
}
