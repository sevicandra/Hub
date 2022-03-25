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
                'tanggalSurat'=>'required',
                'penyampaian_laporan_id'=>'required',
            ]);
            suratPersetujuan::create($ValidatedData);
            tiket::find($tiket->id)->update([
                'persetujuan' =>0,
                'lelang' => 1,
            ]);

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
            $message=nl2br("Yang terhormat Bapak/Ibu Operator Satuan Kerja ". $tiket->permohonans->satuanKerja->namaSatker. ",\nPersetujuan Penghapusan BMN atas permohonan Anda Nomor: ". $tiket->permohonans->nomorSurat. " telah Terbit silakan berkoordinasi dengan PIC Satuan Kerja Anda untuk dilakukan Penggambilan/Pengiriman. \nTerima Kasih. \nApabila Bapak/Ibu ingin berkonsultasi silahkan klik tautan berikut <a>https://linktr.ee/ternate.responsif</a> ");//masukkan isi pesan
            
            // Send_SMS($to,$message);
            return $message;
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
