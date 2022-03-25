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
        //
        return view('pindaiPenilaian',[
            'data'=>permohonanPenilaian::orderBy('created_at', 'desc')->get(),
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

            function Send_SMS($to,$text){
                $pecah              = explode(",",$to);
                $jumlah             = count($pecah);
                $from               = "coba"; //Sender ID or SMS Masking Name, DO NOT LEAVE BLANK, sms will not be sent
                $apikey             = "019d79d4831ab5edd9b529e8deb0c1e1-ca4b5ee9-3db6-42f3-819b-1127a99650bb"; //Get your API Key from our sms dashboard
                $postUrl            = "https://api.smsviro.com/restapi/sms/1/text/advanced"; # DO NOT CHANGE THIS
                
                for($i=0; $i<$jumlah; $i++){
                    if(substr($pecah[$i],0,2) == "62" || substr($pecah[$i],0,3) == "+62"){
                        $pecah = $pecah;
                    }elseif(substr($pecah[$i],0,1) == "0"){
                        $pecah[$i][0] = "X";
                        $pecah = str_replace("X", "62", $pecah);
                    }else{
                        echo "Invalid mobile number format";
                    }
                    $destination = array("to" => $pecah[$i]);
                    $message     = array("from" => $from,
                                         "destinations" => $destination,
                                         "text" => $text,
                                         "smsCount" => 2);
                    $postData           = array("messages" => array($message));
                    $postDataJson       = json_encode($postData);
                    $ch                 = curl_init();
                    $header = array("Content-Type:application/json", "Accept:application/json", "Authorization: App ".$apikey);
                    
                    curl_setopt($ch, CURLOPT_URL, $postUrl);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                    curl_setopt($ch, CURLOPT_MAXREDIRS, 2);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJson);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $response = curl_exec($ch);
                    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    $responseBody = json_decode($response);
                    curl_close($ch);
                }   
            }
            
            $to=$tiket->nomorhp;//masukkan nomor tujuan
            $message=nl2br("Yang terhormat Bapak/Ibu Operator Satuan Kerja ". $tiket->permohonans->satuanKerja->namaSatker. "\nPermohonan Persetujuan Penjualan Anda Nomor ". $tiket->permohonans->nomorSurat. " telah dinyatakan Lengkap mohon menunggu untuk penetapan jadwal penilaian \n Terima Kasih \n Apabila Bapak/Ibu ingin berkonsultasi silahkan klik tautan berikut https://linktr.ee/ternate.responsif");//masukkan isi pesan
            
            // Send_SMS($to,$message);
            return redirect('/permohonan');     
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
        //
        if (isset($penilaian->pemberitahuanPenilaian)) {
            return view('pindaiLaporanPenilaian', [
                'data'=>$penilaian->pemberitahuanPenilaian,
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
