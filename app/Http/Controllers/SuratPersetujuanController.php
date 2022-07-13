<?php

namespace App\Http\Controllers;

use App\Models\tiket;
use Illuminate\Http\Request;
use App\Models\suratPersetujuan;
use App\Models\penyampaianLaporan;
use App\Models\mediaSuratPersetujuan;
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
                    'fileUpload'=>'required|mimes:pdf'
                ]);

                $suratPersetujuan=suratPersetujuan::create($ValidatedData);
                tiket::find($tiket->id)->update([
                    'persetujuan' =>0,
                    'lelang' => 1,
                ]);

                $path = $request->file('fileUpload')->store('suratPersetujuan');

                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://graph.facebook.com/v13.0/'.config('whatsapp.phoneNumber').'/media',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => array('file'=> new \CURLFILE($request->file('fileUpload'),'application/pdf', 'test.pdf'),'messaging_product' => 'whatsapp'),
                  CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.config('whatsapp.key')
                  ),
                ));
                
                $response = curl_exec($curl);
                curl_close($curl);
                $wa_id=json_decode($response);
                
                $media=mediaSuratPersetujuan::create([
                    'surat_persetujuan_id'=>$suratPersetujuan->id,
                    'file'=>$path,
                    'Wa_id'=>$wa_id->id
                ]);
                
                if ($request->kirimNotifikasi) {
                    $toOperator=$tiket->permohonans->satuanKerja->profil->noTeleponOperator;
                    sendDocument($toOperator, "Surat Persetujuan Penghapusan BMN atas permohonan Anda Nomor: ". $tiket->permohonans->nomorSurat, $media->Wa_id, config('whatsapp.key'),config('whatsapp.phoneNumber'));
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


    public function preview(suratPersetujuan $preview)
    {
        return json_encode($preview->media);
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
