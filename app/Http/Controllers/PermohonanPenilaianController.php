<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tiket;
use App\Models\permohonan;
use Illuminate\Http\Request;
use App\Models\whatsappReport;
use App\Models\permohonanPenilaian;

class PermohonanPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' || auth()->user()->jabatan === '11') {
            return view('pindai.Penilaian',[
                'data'=>permohonanPenilaian::orderBy('tanggalSurat', 'desc')->Search()->paginate(20)->withQueryString(),
                'penilaianview'=>'',
                'title'=> 'TERNATE-HUB || PINDAI',
                'favicon'=>'/img/ico/pindai.png',
                'search'=>''
            ]);
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12') {
            $tiket = permohonan::all()->find($request->permohonan_id)->tiket;
            $key= $tiket->permohonan;
            if ($key === 1) {
                $ValidatedData=$request->validate(
                    [
                        'nomorSurat'=>'required',
                        'tanggalSurat'=>'required',
                        'permohonan_id'=>'required',
                        'hal'=>'required'
                    ]);
                $permohonanPenilaian=permohonanPenilaian::create($ValidatedData);
                $data = permohonan::all()->find($request->permohonan_id)->tiket_id;
                tiket::where('id', $data)->update(['permohonan'=>0,'penilaian'=>1]);
                                
                if ($request->kirimNotifikasi) {
                    $toOperator=$tiket->permohonans->satuanKerja->profil->noTeleponOperator;
                    $message="Permohonan Persetujuan Penjualan Anda Nomor ". $tiket->permohonans->nomorSurat. " telah dinyatakan Lengkap mohon menunggu untuk penetapan jadwal penilaian";
                    $waReport=notifikasiLayanan($tiket->permohonans->satuanKerja->namaSatker, $message, $toOperator,config('whatsapp.key'),config('whatsapp.phoneNumber'));
                    whatsappReport::create([
                        'parent_id'=>$permohonanPenilaian->id,
                        'report'=>$waReport,
                        'parent_type'=>'App\Models\permohonanPenilaian'
                    ]);
                }

                $to=User::where('jabatan', '09')->orwhere('jabatan', '10')->get();
                notifikasiPermohonanInternal($to, auth()->user()->nama, "Permohonan Penilaian BMN pada Satuan Kerja ".$tiket->permohonans->satuanKerja->namaSatker." telah dikirim melalui KPKNL TERNATE-HUB",config('whatsapp.key'),config('whatsapp.phoneNumber'));
                return redirect('/permohonan');     
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permohonanPenilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(permohonanPenilaian $penilaian)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' || auth()->user()->jabatan === '11') {
            return view('pindai.LaporanPenilaian', [
                'data'=>$penilaian->pemberitahuanPenilaian,
                'title'=> 'TERNATE-HUB || PINDAI',
                'favicon'=>'/img/ico/pindai.png'
            ]);
        }else{
            abort(403);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permohonanPenilaian  $permohonanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(permohonanPenilaian $permohonanPenilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\permohonanPenilaian  $permohonanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permohonanPenilaian $permohonanPenilaian)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permohonanPenilaian  $permohonanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(permohonanPenilaian $permohonanPenilaian)
    {
        //
    }
}
