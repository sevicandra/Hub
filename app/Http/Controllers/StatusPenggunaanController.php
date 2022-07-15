<?php

namespace App\Http\Controllers;

use App\Models\satuanKerja;
use Illuminate\Http\Request;
use App\Models\statusPenggunaan;
use App\Models\whatsappReport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;


class StatusPenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('PSP.index', [
            'datas'=>statusPenggunaan::orderby('tanggal', 'desc')->Search()->paginate(20)->withQueryString(),
            'search'=>''
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
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12') {
            $request->validate([
                'nomor'=>'required',
                'kodeSurat'=>'required',
                'tanggal'=>'required',
                'kodeSatker'=>'required|exists:App\Models\satuanKerja,kodeSatker',
                'fileUpload'=>'required|mimes:pdf'
            ]);

            if (satuanKerja::where('kodeSatker', strval( $request->kodeSatker ))->first()->profil) {

            }else{
                return 'Profil Satker Tidak Ditemukan Mohon Lengkapi Profil Satker Terlebih Dahulu';
            }

            $path = $request->file('fileUpload')->store('status-penggunaan');

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
                
            $statusPenggunaan=statusPenggunaan::create([
                'nomor'=>$request->nomor,
                'kodeSurat'=>$request->kodeSurat,
                'tanggal'=>$request->tanggal,
                'kodeSatker'=>$request->kodeSatker,
                'file'=>$path,
                'Wa_id'=>$wa_id->id
            ]);
                
            if ($request->kirimNotifikasi) {
                $toOperator=$statusPenggunaan->satuanKerja->profil->noTeleponOperator;
                $waReport=sendDocument($toOperator, "Penetapan Status Penggunaan BMN pada Satuan Kerja ".$statusPenggunaan->satuanKerja->namaSatker, $statusPenggunaan->Wa_id, config('whatsapp.key'),config('whatsapp.phoneNumber'));
                whatsappReport::create([
                    'parent_id'=>$statusPenggunaan->id,
                    'report'=>$waReport,
                    'parent_type'=>'App\Models\statusPenggunaan'
                ]);
            }
            return Redirect::back();
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\statusPenggunaan  $statusPenggunaan
     * @return \Illuminate\Http\Response
     */
    public function show(statusPenggunaan $statusPenggunaan)
    {
        return json_encode($statusPenggunaan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\statusPenggunaan  $statusPenggunaan
     * @return \Illuminate\Http\Response
     */
    public function edit(statusPenggunaan $statusPenggunaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\statusPenggunaan  $statusPenggunaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, statusPenggunaan $statusPenggunaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\statusPenggunaan  $statusPenggunaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(statusPenggunaan $statusPenggunaan)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12') {
            Storage::delete($statusPenggunaan->file);
            $statusPenggunaan->delete();
            return Redirect::Back();
        }else{
            abort(403);
        }
    }
}
