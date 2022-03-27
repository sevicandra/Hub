<?php

namespace App\Http\Controllers;

use App\Models\tiket;
use Illuminate\Http\Request;
use App\Models\suratPersetujuan;
use App\Models\penyampaianLaporan;
use App\Http\Requests\UpdatesuratPersetujuanRequest;

class SuratPersetujuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pindaiPersetujuan',[
            'data'=>penyampaianLaporan::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function potensi()
    {
        return view('pindaiPotensiLelang',[
            'data'=>suratPersetujuan::orderBy('created_at', 'desc')->get(),
        ]);
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
        $tiket = penyampaianLaporan::all()->find($request->penyampaian_laporan_id)->pemberitahuanPenilaian->permohonanPenilaian->permohonan->tiket;
        $key = penyampaianLaporan::all()->find($request->penyampaian_laporan_id)->suratPersetujuan;
        if (!isset($key)) {
            $ValidatedData=$request->validate([
                'nomorSurat'=>'required',
                'hal'=>'required',
                'tanggalSurat'=>'required',
                'penyampaian_laporan_id'=>'required',
            ]);
            suratPersetujuan::create($ValidatedData);
            tiket::find($tiket->id)->update([
                'persetujuan' =>0,
                'lelang' => 1,
            ]);

            
            $to=$tiket->nomorhp;//masukkan nomor tujuan
            $message=nl2br("Yang terhormat Bapak/Ibu Operator Satuan Kerja ". $tiket->permohonans->satuanKerja->namaSatker. ",\nPersetujuan Penghapusan BMN atas permohonan Anda Nomor: ". $tiket->permohonans->nomorSurat. " telah Terbit silakan berkoordinasi dengan PIC Satuan Kerja Anda untuk dilakukan Penggambilan/Pengiriman. \nTerima Kasih. \nApabila Bapak/Ibu ingin berkonsultasi silahkan klik tautan berikut <a>https://linktr.ee/ternate.responsif</a> ");//masukkan isi pesan
            
            // Send_SMS($to,$message);
            return $to. $message;
            return redirect('/persetujuan');
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\suratPersetujuan  $suratPersetujuan
     * @return \Illuminate\Http\Response
     */
    public function show(suratPersetujuan $potensi_lelang)
    {
        return view('pindaiPermohonanLelang',[
            'data'=> $potensi_lelang,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\suratPersetujuan  $suratPersetujuan
     * @return \Illuminate\Http\Response
     */
    public function edit(suratPersetujuan $suratPersetujuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesuratPersetujuanRequest  $request
     * @param  \App\Models\suratPersetujuan  $suratPersetujuan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesuratPersetujuanRequest $request, suratPersetujuan $suratPersetujuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\suratPersetujuan  $suratPersetujuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(suratPersetujuan $suratPersetujuan)
    {
        //
    }
}
