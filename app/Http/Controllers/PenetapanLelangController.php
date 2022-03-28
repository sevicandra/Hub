<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penetapanLelang;
use App\Models\permohonanLelang;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UpdatepenetapanLelangRequest;

class PenetapanLelangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pindaiPenetapanLelang',[
            'data'=>penetapanLelang::orderBy('created_at', 'desc')->get()
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
        $data = permohonanLelang::all()->find($request->permohonan_lelang_id);
        if (!$data->penetapanLelang) {
            $validatedData=$request->validate([
                'nomorSurat'=>'required',
                'tanggalSurat'=>'required',
                'tanggalLelang'=>'required',
                'permohonan_lelang_id'=>'required'
            ]);
            $penetapanLelang=penetapanLelang::create($validatedData);

            $toOperator=$penetapanLelang->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->profil->noTeleponOperator;
            $messageOperator=nl2br("Yang terhormat Bapak/Ibu Operator Satuan Kerja ". $penetapanLelang->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker. "\nPermohonan Lelang Anda Nomor ". $data->nomorSurat. " telah ditetapkan pada tanggal ". indonesiaDate($penetapanLelang->tanggalLelang). " \n Terima Kasih \n Apabila Bapak/Ibu ingin berkonsultasi silahkan klik tautan berikut https://linktr.ee/ternate.responsif");//masukkan isi pesan
            $toKaSatker=$penetapanLelang->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->noTeleponKepalaSatker;
            $messageKaSatker=nl2br("Yang terhormat Bapak/Ibu Kepala Satuan Kerja ". $penetapanLelang->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker. "\nPermohonan Lelang Anda Nomor ". $data->nomorSurat. " telah ditetapkan pada tanggal ". indonesiaDate($penetapanLelang->tanggalLelang). " \n Terima Kasih \n Apabila Bapak/Ibu ingin berkonsultasi silahkan klik tautan berikut https://linktr.ee/ternate.responsif");//masukkan isi pesan

            
            return nl2br(
                "Nomor Tujuan: ". $toOperator. "\n". 
                "Pesan: ".$messageOperator. "\n". 
                
                "Nomor Tujuan: ". $toKaSatker. "\n". 
                "Pesan: ".$messageKaSatker
            );

            // Send_SMS($to,$message);
            return redirect::back();
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penetapanLelang  $penetapanLelang
     * @return \Illuminate\Http\Response
     */
    public function show(penetapanLelang $penetapanLelang)
    {
        return view('pindaiRisalah',[
            'data'=>$penetapanLelang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penetapanLelang  $penetapanLelang
     * @return \Illuminate\Http\Response
     */
    public function edit(penetapanLelang $penetapanLelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\penetapanLelang  $penetapanLelang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, penetapanLelang $penetapanLelang)
    {   
        if ($penetapanLelang->status != 1) {
            foreach ($penetapanLelang->barangLelang as $item) {
    
                switch ($item->status) {
                    case 1:
                        $item->barang->update(['status'=> 2]);
                        break;
                    
                    default:
                    $item->barang->update(['status'=> 0]);
                        break;
                }
            };
            $penetapanLelang->update(['status'=> 1]);
            $penetapanLelang->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->tiket->update(['lelang'=>0]);
            return Redirect::back();
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penetapanLelang  $penetapanLelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(penetapanLelang $penetapanLelang)
    {
        //
    }
}
