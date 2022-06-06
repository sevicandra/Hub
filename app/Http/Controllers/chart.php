<?php

namespace App\Http\Controllers;

use App\Models\pnbp;
use Illuminate\Http\Request;
use App\Models\kepuasanPelanggan;
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
                    if($data->konsolidasi === 'TLK'){
                        $capaian[]=floatval($data->capaianlast->capaian);
                    }elseif($data->konsolidasi === 'AVG'){
                        $capaian[]=$data->capaian->avg('capaian');
                    }
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
            $response['capaian']=$capaian;
            $response['target']=$target;
            $response['realisasi']=$realisasi;
            return json_encode($response);
        }else{
            $response['namaIKU']=[];
            $response['capaian']=[];
            $response['target']=[];
            $response['realisasi']=[];
            return json_encode($response);
        }
        
    }

    public function NKOTW(Request $request){
        $NKO = kinerjaOrganisasi::orderBy('kodeIKU')->where('tahun', $request->tahun)->get();
        
        if($NKO->first()){
            $i=0;
            foreach ($NKO as $data) {
                $namaIKU[]=$data->namaIKU;
                if($data->capaian->first()){
                    switch ($request->triwulan) {
                        case 'Q1':
                            if ($data->konsolidasi === 'TLK') {
                                if ($data->capaian->where('bulan', '<=', 3)->first()) {
                                    $bulan=$data->capaian->where('bulan', '<=', 3)->max('bulan');
                                    $capaian[]= floatval($data->capaian->where('bulan', $bulan)->max()->capaian);
                                }else{
                                    $capaian[]=0;
                                }
                            }elseif($data->konsolidasi === 'AVG'){
                                if ($data->capaian->where('bulan', '<=', 3)->first()) {
                                    $capaian[]= $data->capaian->where('bulan', '<=', 3)->avg('capaian');
                                }else{
                                    $capaian[]=0;
                                }
                            }
                            break;
                        case 'Q2':
                            if ($data->konsolidasi === 'TLK') {
                                if ($data->capaian->where('bulan', '<=', 6)->first()) {
                                    $bulan=$data->capaian->where('bulan', '<=', 6)->max('bulan');
                                    $capaian[]= floatval($data->capaian->where('bulan', $bulan)->max()->capaian);
                                }else{
                                    $capaian[]=0;
                                }
                            }elseif($data->konsolidasi === 'AVG'){
                                if ($data->capaian->where('bulan', '<=', 6)->first()) {
                                    $capaian[]= $data->capaian->where('bulan', '<=', 6)->avg('capaian');
                                }else{
                                    $capaian[]=0;
                                }
                            }
                            break;
                        case 'Q3':
                            if ($data->konsolidasi === 'TLK') {
                                if ($data->capaian->where('bulan', '<=', 9)->first()) {
                                    $bulan=$data->capaian->where('bulan', '<=', 9)->max('bulan');
                                    $capaian[]= $data->capaian->where('bulan', $bulan)->max()->capaian;
                                }else{
                                    $capaian[]=0;
                                }
                            }elseif($data->konsolidasi === 'AVG'){
                                if ($data->capaian->where('bulan', '<=', 9)->first()) {
                                    $capaian[]= floatval($data->capaian->where('bulan', '<=', 9)->avg('capaian'));
                                }else{
                                    $capaian[]=0;
                                }
                            }
                            break;
                        case 'Q4':
                            if ($data->konsolidasi === 'TLK') {
                                if ($data->capaian->where('bulan', '<=', 12)->first()) {
                                    $bulan=$data->capaian->where('bulan', '<=', 12)->max('bulan');
                                    $capaian[]= $data->capaian->where('bulan', $bulan)->max()->capaian;
                                }else{
                                    $capaian[]=0;
                                }
                            }elseif($data->konsolidasi === 'AVG'){
                                if ($data->capaian->where('bulan', '<=', 12)->first()) {
                                    $capaian[]= floatval($data->capaian->where('bulan', '<=', 12)->avg('capaian'));
                                }else{
                                    $capaian[]=0;
                                }
                            }
                            break;
                    }
                }else{
                    $capaian[]=0;
                }

                if ($data->target->first()) {
                    
                    switch ($request->triwulan) {
                        case 'Q1':
                            if ($data->target->where('periode','Q1')->first()) {
                                $target[]= floatval($data->target->where('periode','Q1')->first()->target);
                            }elseif($data->target->where('periode','Q2')->first()) {
                                $target[]= floatval($data->target->where('periode','Q2')->first()->target);
                            }elseif($data->target->where('periode','Q3')->first()) {
                                $target[]= floatval($data->target->where('periode','Q3')->first()->target);
                            }elseif($data->target->where('periode','Q4')->first()) {
                                $target[]= floatval($data->target->where('periode','Q4')->first()->target);
                            }
                            break;
                        case 'Q2':
                            if($data->target->where('periode','Q2')->first()) {
                                $target[]= floatval($data->target->where('periode','Q2')->first()->target);
                            }elseif($data->target->where('periode','Q3')->first()) {
                                $target[]= floatval($data->target->where('periode','Q3')->first()->target);
                            }elseif($data->target->where('periode','Q4')->first()) {
                                $target[]= floatval($data->target->where('periode','Q4')->first()->target);
                            }elseif($data->target->where('periode','Q1')->first()) {
                                $target[]= floatval($data->target->where('periode','Q1')->first()->target);
                            }
                            break;
                        case 'Q3':
                            if($data->target->where('periode','Q3')->first()) {
                                $target[]= floatval($data->target->where('periode','Q3')->first()->target);
                            }elseif($data->target->where('periode','Q4')->first()) {
                                $target[]= floatval($data->target->where('periode','Q4')->first()->target);
                            }elseif($data->target->where('periode','Q2')->first()) {
                                $target[]= floatval($data->target->where('periode','Q2')->first()->target);
                            }elseif($data->target->where('periode','Q1')->first()) {
                                $target[]= floatval($data->target->where('periode','Q1')->first()->target);
                            }
                            break;
                        case 'Q4':
                            if($data->target->where('periode','Q4')->first()) {
                                $target[]= floatval($data->target->where('periode','Q4')->first()->target);
                            }elseif($data->target->where('periode','Q3')->first()) {
                                $target[]= floatval($data->target->where('periode','Q3')->first()->target);
                            }elseif($data->target->where('periode','Q2')->first()) {
                                $target[]= floatval($data->target->where('periode','Q2')->first()->target);
                            }elseif($data->target->where('periode','Q1')->first()) {
                                $target[]= floatval($data->target->where('periode','Q1')->first()->target);
                            }
                            break;
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
                }else{
                    $target[]=null;
                    $realisasi[]=0;
                }
                
                $i++;
            }
            
            $response['namaIKU']=$namaIKU;
            $response['capaian']=$capaian;
            $response['target']=$target;
            $response['realisasi']=$realisasi;
            return json_encode($response);
        }else{
            $response['namaIKU']=[];
            $response['capaian']=[];
            $response['target']=[];
            $response['realisasi']=[];
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

    public function kepuasanPelanggan(Request $request){
        switch ($request->tusis) {
            case 'ALL':
                $kepuasan['tangibles'] = kepuasanPelanggan::all()->avg('tangibles');
                $kepuasan['reliability'] = kepuasanPelanggan::all()->avg('reliability');
                $kepuasan['responsiveness'] = kepuasanPelanggan::all()->avg('responsiveness');
                $kepuasan['assurance'] = kepuasanPelanggan::all()->avg('assurance');
                $kepuasan['empathy'] = kepuasanPelanggan::all()->avg('empathy');
                return json_encode($kepuasan);
                break;
            default:
                $kepuasan['tangibles'] = kepuasanPelanggan::where('layanan', $request->tusis)->get()->avg('tangibles');
                $kepuasan['reliability'] = kepuasanPelanggan::where('layanan', $request->tusis)->get()->avg('reliability');
                $kepuasan['responsiveness'] = kepuasanPelanggan::where('layanan', $request->tusis)->get()->avg('responsiveness');
                $kepuasan['assurance'] = kepuasanPelanggan::where('layanan', $request->tusis)->get()->avg('assurance');
                $kepuasan['empathy'] = kepuasanPelanggan::where('layanan', $request->tusis)->get()->avg('empathy');
                return json_encode($kepuasan);
                break;
        }
    }
}
