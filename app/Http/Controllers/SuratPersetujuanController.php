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
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12') {
            return view('pindai.Persetujuan',[
                'data'=>penyampaianLaporan::orderBy('tanggalSurat', 'desc')->Search()->paginate(20)->withQueryString(),
                'persetujuanview'=>'',
                'title'=> 'TERNATE-HUB || PINDAI',
                'favicon'=>'/img/ico/pindai.png',
                'search'=>''
            ]);
        }else{
            abort(403);
        }
    }

    public function potensi()
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11') {
            return view('pindai.PotensiLelang',[
                'data'=>suratPersetujuan::orderBy('tanggalSurat', 'desc')->Search()->paginate(20)->withQueryString(),
                'potensiLelangview'=>'',
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
                
                if ($request->kirimNotifikasi) {
                    $toOperator=$tiket->permohonans->satuanKerja->profil->noTeleponOperator;//masukkan nomor tujuan
                    $message="Persetujuan Penghapusan BMN atas permohonan Anda Nomor: ". $tiket->permohonans->nomorSurat. " telah terbit silakan berkoordinasi dengan PIC Satuan Kerja Anda untuk dilakukan Penggambilan/Pengiriman";
                    // $messageOperator=nl2br("Yang terhormat Bapak/Ibu Operator Satuan Kerja ". $tiket->permohonans->satuanKerja->namaSatker. ",\nPersetujuan Penghapusan BMN atas permohonan Anda Nomor: ". $tiket->permohonans->nomorSurat. " telah Terbit silakan berkoordinasi dengan PIC Satuan Kerja Anda untuk dilakukan Penggambilan/Pengiriman. \nTerima Kasih. \nApabila Bapak/Ibu ingin berkonsultasi silahkan klik tautan berikut <a>https://linktr.ee/ternate.responsif</a> ");//masukkan isi pesan
                    // $toKaSatker=$tiket->permohonans->satuanKerja->profil->noTeleponKepalaSatker;//masukkan nomor tujuan
                    // $messageKaSatker=nl2br("Yang terhormat Bapak/Ibu Operator Satuan Kerja ". $tiket->permohonans->satuanKerja->namaSatker. ",\nPersetujuan Penghapusan BMN atas permohonan Anda Nomor: ". $tiket->permohonans->nomorSurat. " telah Terbit silakan berkoordinasi dengan PIC Satuan Kerja Anda untuk dilakukan Penggambilan/Pengiriman. \nTerima Kasih. \nApabila Bapak/Ibu ingin berkonsultasi silahkan klik tautan berikut <a>https://linktr.ee/ternate.responsif</a> ");//masukkan isi pesan
                        
                    // return nl2br(
                    //     "Nomor Tujuan: ". $toOperator. "\n". 
                    //     "Pesan: ".$messageOperator. "\n"
                        
                    //     // "Nomor Tujuan: ". $toKaSatker. "\n". 
                    //     // "Pesan: ".$messageKaSatker
                    // );
                    // Send_SMS($to,$message);
                    notifikasiLayanan($tiket->permohonans->satuanKerja->namaSatker, $message, $toOperator);
                }
                return redirect('/persetujuan');
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
     * @param  \App\Models\suratPersetujuan  $suratPersetujuan
     * @return \Illuminate\Http\Response
     */
    public function show(suratPersetujuan $potensi_lelang)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11') {
            return view('pindai.PermohonanLelang',[
                'data'=> $potensi_lelang,
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
