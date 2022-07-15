<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\whatsappReport;
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
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11') {
            return view('pindai.PenetapanLelang',[
                'data'=>penetapanLelang::orderBy('tanggalSurat', 'desc')->Search()->paginate(20)->withQueryString(),
                'penetapanLelangview'=>'',
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
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11') {
            $data = permohonanLelang::all()->find($request->permohonan_lelang_id);
            if (!$data->penetapanLelang) {
                $validatedData=$request->validate([
                    'nomorSurat'=>'required',
                    'tanggalSurat'=>'required',
                    'tanggalLelang'=>'required',
                    'permohonan_lelang_id'=>'required'
                ]);
                $penetapanLelang=penetapanLelang::create($validatedData);
                if ($request->kirimNotifikasi) {
                    if ($data->jenis === 'App\Models\suratPersetujuan') {
                        $toOperator=$penetapanLelang->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->profil->noTeleponOperator;
                        $messageOperator=nl2br("Yang terhormat Bapak/Ibu Operator Satuan Kerja ". $penetapanLelang->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker. "\nPermohonan Lelang Anda Nomor ". $data->nomorSurat. " telah ditetapkan pada tanggal ". indonesiaDate($penetapanLelang->tanggalLelang). "  \n Apabila Bapak/Ibu ingin berkonsultasi silahkan klik tautan berikut https://linktr.ee/ternate.responsif");//masukkan isi pesan
                        $message="Permohonan Lelang Anda Nomor ". $data->nomorSurat. " telah ditetapkan pada tanggal ". indonesiaDate($penetapanLelang->tanggalLelang);
                        $waReport=notifikasiLayanan($penetapanLelang->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker, $message, $toOperator,config('whatsapp.key'),config('whatsapp.phoneNumber'));
                        whatsappReport::create([
                            'parent_id'=>$penetapanLelang->id,
                            'report'=>$waReport,
                            'parent_type'=>'App\Models\penetapanLelang'
                        ]);
                    
                    }elseif($data->jenis === 'App\Models\tiket'){
                        $toOperator=$data->pemohonLelang->kontakPemohon;
                        $messageOperator=nl2br("Yang terhormat Bapak/Ibu PIC ". $data->pemohonLelang->pemohon. "\nPermohonan Lelang Anda Nomor ". $data->nomorSurat. " telah ditetapkan pada tanggal ". indonesiaDate($penetapanLelang->tanggalLelang). "  \n Apabila Bapak/Ibu ingin berkonsultasi silahkan klik tautan berikut https://linktr.ee/ternate.responsif");//masukkan isi pesan
                        return nl2br(
                            "Nomor Tujuan: ". $toOperator. "\n". 
                            "Pesan: ".$messageOperator. "\n"
                        );
                        $message="Permohonan Lelang Anda Nomor ". $data->nomorSurat. " telah ditetapkan pada tanggal ". indonesiaDate($penetapanLelang->tanggalLelang);
                        $waReport=notifikasiLayanan($penetapanLelang->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker, $message, $toOperator,config('whatsapp.key'),config('whatsapp.phoneNumber'));
                        whatsappReport::create([
                            'parent_id'=>$penetapanLelang->id,
                            'report'=>$waReport,
                            'parent_type'=>'App\Models\penetapanLelang'
                        ]);
                    }
                }
    
                return redirect::back();
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
     * @param  \App\Models\penetapanLelang  $penetapanLelang
     * @return \Illuminate\Http\Response
     */
    public function show(penetapanLelang $penetapanLelang)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11') {
            return view('pindai.Risalah',[
                'data'=>$penetapanLelang,
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
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11') {
            if ($penetapanLelang->status != 1) {
                if ($penetapanLelang->permohonanLelang->jenis === 'App\Models\suratPersetujuan') {
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
                }elseif($penetapanLelang->permohonanLelang->jenis === 'App\Models\tiket'){
                    $penetapanLelang->update(['status'=> 1]);
                    $penetapanLelang->permohonanLelang->suratPersetujuan->update(['lelang'=>0]);
                }else{
                    abort(404);
                }

                return Redirect::back();

            }else{
                abort(403);
            }
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
