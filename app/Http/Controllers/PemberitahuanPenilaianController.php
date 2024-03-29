<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\whatsappReport;
use App\Models\permohonanPenilaian;
use App\Models\pemberitahuanPenilaian;


class PemberitahuanPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' || auth()->user()->jabatan === '11') {
            $key = permohonanPenilaian::all()->find($request->permohonan_penilaian_id)->pemberitahuanPenilaian;
            if (!isset($key)) {
                $ValidatedData = $request->validate([
                    'nomorSurat' => 'required',
                    'tanggalSurat' => 'required',
                    'tanggalMulaiSurvei' => 'required',
                    'tanggalSelesaiSurvei' => 'required',
                    'permohonan_penilaian_id' => 'required'
                ]);
    
                $pemberitahuanPenilaian = pemberitahuanPenilaian::create($ValidatedData);
    
                $dateMulaiSurvei = date_create($request->tanggalMulaiSurvei);
                $tglMulaiSurvei = date_format($dateMulaiSurvei, "d");
                $blnMulaiSurvei = date_format($dateMulaiSurvei, "m");
                $tahunMulaiSurvei = date_format($dateMulaiSurvei, "Y");
                switch ($blnMulaiSurvei) {
                    case '1':
                        $blnMulaiSurvei = 'Januari';
                        break;
                    case '2':
                        $blnMulaiSurvei = 'Februari';
                        break;
                    case '3':
                        $blnMulaiSurvei = 'Maret';
                        break;
                    case '4':
                        $blnMulaiSurvei = 'April';
                        break;
                    case '5':
                        $blnMulaiSurvei = 'Mei';
                        break;
                    case '6':
                        $blnMulaiSurvei = 'Juni';
                        break;
                    case '7':
                        $blnMulaiSurvei = 'Juli';
                        break;
                    case '8':
                        $blnMulaiSurvei = 'Agustus';
                        break;
                    case '9':
                        $blnMulaiSurvei = 'September';
                        break;
                    case '10':
                        $blnMulaiSurvei = 'Oktober';
                        break;
                    case '11':
                        $blnMulaiSurvei = 'November';
                        break;
                    case '12':
                        $blnMulaiSurvei = 'Desember';
                        break;
                }
                $tanggalMulaiSurvei = $tglMulaiSurvei  . ' ' . $blnMulaiSurvei . ' ' . $tahunMulaiSurvei;
    
                $dateSelesaiSurvei = date_create($request->tanggalSelesaiSurvei);
                $tglSelesaiSurvei = date_format($dateSelesaiSurvei, "d");
                $blnSelesaiSurvei = date_format($dateSelesaiSurvei, "m");
                $tahunSelesaiSurvei = date_format($dateSelesaiSurvei, "Y");
                switch ($blnSelesaiSurvei) {
                    case '1':
                        $blnSelesaiSurvei = 'Januari';
                        break;
                    case '2':
                        $blnSelesaiSurvei = 'Februari';
                        break;
                    case '3':
                        $blnSelesaiSurvei = 'Maret';
                        break;
                    case '4':
                        $blnSelesaiSurvei = 'April';
                        break;
                    case '5':
                        $blnSelesaiSurvei = 'Mei';
                        break;
                    case '6':
                        $blnSelesaiSurvei = 'Juni';
                        break;
                    case '7':
                        $blnSelesaiSurvei = 'Juli';
                        break;
                    case '8':
                        $blnSelesaiSurvei = 'Agustus';
                        break;
                    case '9':
                        $blnSelesaiSurvei = 'September';
                        break;
                    case '10':
                        $blnSelesaiSurvei = 'Oktober';
                        break;
                    case '11':
                        $blnSelesaiSurvei = 'November';
                        break;
                    case '12':
                        $blnSelesaiSurvei = 'Desember';
                        break;
                }
                $tanggalSelesaiSurvei = $tglSelesaiSurvei  . ' ' . $blnSelesaiSurvei . ' ' . $tahunSelesaiSurvei;
    
                if ($request->tanggalMulaiSurvei === $request->tanggalSelesaiSurvei) {
                    $tanggalsurvei = $tanggalMulaiSurvei;
                } else {
                    if ($tahunMulaiSurvei === $tahunSelesaiSurvei && $blnMulaiSurvei === $blnSelesaiSurvei) {
                        $survei = $tglMulaiSurvei . ' s.d. ' . $tglSelesaiSurvei . ' ' . $blnSelesaiSurvei . ' ' . $tahunSelesaiSurvei;
                        $tanggalsurvei = $survei;
                    } else {
                        if ($tahunMulaiSurvei === $tahunSelesaiSurvei) {
                            $survei = $tglMulaiSurvei . ' ' . $blnMulaiSurvei . ' s.d. ' . $tglSelesaiSurvei . ' ' . $blnSelesaiSurvei . ' ' . $tahunSelesaiSurvei;
                            $tanggalsurvei = $survei;
                        } else {
                            $survei = $tanggalMulaiSurvei. ' s.d. ' . $tanggalSelesaiSurvei;
                            $tanggalsurvei = $survei;
                        }
                    }
                }
                
                if ($request->kirimNotifikasi) {
                    $toOperator = $pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->profil->noTeleponOperator; //masukkan nomor tujuan
                    $message="Kami telah menjadwalkan survei lapangan penilaian atas permohonan penghapusan BMN nomor " . $pemberitahuanPenilaian->permohonanPenilaian->permohonan->nomorSurat . "  pada tanggal " . $tanggalsurvei;
                    $waReport=notifikasiLayanan($pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker, $message, $toOperator,config('whatsapp.key'),config('whatsapp.phoneNumber'));
                    whatsappReport::create([
                        'parent_id'=>$pemberitahuanPenilaian->id,
                        'report'=>$waReport,
                        'parent_type'=>'App\Models\pemberitahuanPenilaian'
                    ]);
                }
    
                return redirect('/penilaian');
            } else {
                abort(403);
            }
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemberitahuanPenilaian  $pemberitahuanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function show(pemberitahuanPenilaian $pemberitahuanPenilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemberitahuanPenilaian  $pemberitahuanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(pemberitahuanPenilaian $pemberitahuanPenilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\pemberitahuanPenilaian  $pemberitahuanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pemberitahuanPenilaian $pemberitahuanPenilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemberitahuanPenilaian  $pemberitahuanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemberitahuanPenilaian $pemberitahuanPenilaian)
    {
        //
    }
}
