<?php

namespace App\Http\Controllers;

use App\Models\tiket;
use App\Models\permohonan;
use Illuminate\Http\Request;
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
                permohonanPenilaian::create($ValidatedData);
                $data = permohonan::all()->find($request->permohonan_id)->tiket_id;
                tiket::where('id', $data)->update(['permohonan'=>0,'penilaian'=>1]);
                
                $toOperator=$tiket->permohonans->satuanKerja->profil->noTeleponOperator;
                $messageOperator=nl2br("Yang terhormat Bapak/Ibu Operator Satuan Kerja ". $tiket->permohonans->satuanKerja->namaSatker. "\nPermohonan Persetujuan Penjualan Anda Nomor ". $tiket->permohonans->nomorSurat. " telah dinyatakan Lengkap mohon menunggu untuk penetapan jadwal penilaian \n Terima Kasih \n Apabila Bapak/Ibu ingin berkonsultasi silahkan klik tautan berikut https://linktr.ee/ternate.responsif");//masukkan isi pesan
                $toKaSatker=$tiket->permohonans->satuanKerja->profil->noTeleponKepalaSatker;
                $messageKaSatker=nl2br("Yang terhormat Bapak/Ibu Kepala Satuan Kerja ". $tiket->permohonans->satuanKerja->namaSatker. "\nPermohonan Persetujuan Penjualan Anda Nomor ". $tiket->permohonans->nomorSurat. " telah dinyatakan Lengkap mohon menunggu untuk penetapan jadwal penilaian \n Terima Kasih \n Apabila Bapak/Ibu ingin berkonsultasi silahkan klik tautan berikut https://linktr.ee/ternate.responsif");//masukkan isi pesan
    
                
                return nl2br(
                    "Nomor Tujuan: ". $toOperator. "\n". 
                    "Pesan: ".$messageOperator. "\n". 
                    
                    "Nomor Tujuan: ". $toKaSatker. "\n". 
                    "Pesan: ".$messageKaSatker
                );
    
    
    
                // Send_SMS($to,$message);
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
