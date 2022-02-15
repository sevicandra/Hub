<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\permohonanPenilaian;

class cetakDokumen extends Controller
{
    public function cetakPermohonanSKSTPenilai(Request $request){
        
        $a = permohonanPenilaian::all()->find($request->permohonan_id);
        if(isset($request->nama)){
            foreach ($request->nama as $key) {
                $c = permohonanPenilaian::all()->find($request->permohonan_id)->users->find($key);
                if (!isset($c)) {
                    permohonanPenilaian::all()->find($request->permohonan_id)->users()->attach($key);
                }
            }
        }

        $b = permohonanPenilaian::all()->find($request->permohonan_id);
        
        $date=date_create($a->tanggalSurat);
        $tglSurat = date_format($date,"d");
        $blnSurat = date_format($date,"m");
        $tahunSurat = date_format($date,"Y");
        switch ($blnSurat) {
            case '1':
                $blnSurat='Januari';
                break;
            case '2':
                $blnSurat='Februari';
                break;
            case '3':
                $blnSurat='Maret';
                break;
            case '4':
                $blnSurat='April';
                break;
            case '5':
                $blnSurat='Mei';
                break;
            case '6':
                $blnSurat='Juni';
                break;
            case '7':
                $blnSurat='Juli';
                break;
            case '8':
                $blnSurat='Agustus';
                break;
            case '9':
                $blnSurat='September';
                break;
            case '10':
                $blnSurat='Oktober';
                break;
            case '11':
                $blnSurat='November';
                break;
            case '12':
                $blnSurat='Desember';
                break;
        }
        $tanggalsurat = $tglSurat  .' '. $blnSurat . ' '. $tahunSurat;

        $dateMulaiSurvei=date_create($request->tanggalMulaiSurvei);
        $tglMulaiSurvei = date_format($dateMulaiSurvei,"d");
        $blnMulaiSurvei = date_format($dateMulaiSurvei,"m");
        $tahunMulaiSurvei = date_format($dateMulaiSurvei,"Y");
        switch ($blnMulaiSurvei) {
            case '1':
                $blnMulaiSurvei='Januari';
                break;
            case '2':
                $blnMulaiSurvei='Februari';
                break;
            case '3':
                $blnMulaiSurvei='Maret';
                break;
            case '4':
                $blnMulaiSurvei='April';
                break;
            case '5':
                $blnMulaiSurvei='Mei';
                break;
            case '6':
                $blnMulaiSurvei='Juni';
                break;
            case '7':
                $blnMulaiSurvei='Juli';
                break;
            case '8':
                $blnMulaiSurvei='Agustus';
                break;
            case '9':
                $blnMulaiSurvei='September';
                break;
            case '10':
                $blnMulaiSurvei='Oktober';
                break;
            case '11':
                $blnMulaiSurvei='November';
                break;
            case '12':
                $blnMulaiSurvei='Desember';
                break;
        }
        $tanggalMulaiSurvei = $tglMulaiSurvei  .' '. $blnMulaiSurvei . ' '. $tahunMulaiSurvei;

        $dateSelesaiSurvei=date_create($request->tanggalSelesaiSurvei);
        $tglSelesaiSurvei = date_format($dateSelesaiSurvei,"d");
        $blnSelesaiSurvei = date_format($dateSelesaiSurvei,"m");
        $tahunSelesaiSurvei = date_format($dateSelesaiSurvei,"Y");
        switch ($blnSelesaiSurvei) {
            case '1':
                $blnSelesaiSurvei='Januari';
                break;
            case '2':
                $blnSelesaiSurvei='Februari';
                break;
            case '3':
                $blnSelesaiSurvei='Maret';
                break;
            case '4':
                $blnSelesaiSurvei='April';
                break;
            case '5':
                $blnSelesaiSurvei='Mei';
                break;
            case '6':
                $blnSelesaiSurvei='Juni';
                break;
            case '7':
                $blnSelesaiSurvei='Juli';
                break;
            case '8':
                $blnSelesaiSurvei='Agustus';
                break;
            case '9':
                $blnSelesaiSurvei='September';
                break;
            case '10':
                $blnSelesaiSurvei='Oktober';
                break;
            case '11':
                $blnSelesaiSurvei='November';
                break;
            case '12':
                $blnSelesaiSurvei='Desember';
                break;
        }
        $tanggalSelesaiSurvei = $tglSelesaiSurvei  .' '. $blnSelesaiSurvei . ' '. $tahunSelesaiSurvei;

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/PermohonanSK-STPenilai.docx');
        $templateProcessor->setValue('nomorSurat', $a->nomorSurat);
        $templateProcessor->setValue('tanggalSurat', $tanggalsurat);
        $templateProcessor->setValue('hal', $a->hal);
        $templateProcessor->setValue('lokasi', $request->lokasi);
        
        if ($request->tanggalMulaiSurvei === $request->tanggalSelesaiSurvei) {
            $templateProcessor->setValue('tanggalSurvei', $tanggalMulaiSurvei);
        }else{
                if($tahunMulaiSurvei === $tahunSelesaiSurvei && $blnMulaiSurvei === $blnSelesaiSurvei){
                    $survei=$tglMulaiSurvei . ' s.d. ' . $tglSelesaiSurvei . ' ' . $blnSelesaiSurvei . ' '. $tahunSelesaiSurvei;
                    $templateProcessor->setValue('tanggalSurvei', $survei);
                }else{
                    if($tahunMulaiSurvei === $tahunSelesaiSurvei){
                        $survei=$tglMulaiSurvei . ' ' . $blnMulaiSurvei . ' s.d. ' . $tglSelesaiSurvei . ' ' . $blnSelesaiSurvei . ' '. $tahunSelesaiSurvei;
                        $templateProcessor->setValue('tanggalSurvei', $survei);
                    }else{
                        $survei=$tglMulaiSurvei . ' ' . $blnMulaiSurvei . ' '. $tahunMulaiSurvei . ' s.d. ' . $tglSelesaiSurvei . ' ' . $blnSelesaiSurvei . ' '. $tahunSelesaiSurvei;
                        $templateProcessor->setValue('tanggalSurvei', $survei);
                    }
                }
            }
        
        $templateProcessor->cloneRow('anggotaTim', $b->users->count());
        $i=1;
        $c = $b->users()->orderByDesc('permohonan_penilaian_user.created_at')->get();
        foreach($c as $user){
            $anggotaTim='anggotaTim#' . $i;
            $NIP='NIP#' . $i;
            $nomor='nomor#'. $i;

            $templateProcessor->setValue($anggotaTim, $user->nama);
            $templateProcessor->setValue($NIP, $user->NIP);
            $templateProcessor->setValue($nomor, $i);
            $i++;
        }
        
        $templateProcessor->saveAs('DocxTemplate/Usulan SK & ST - '. $request->permohonan_id. '.docx');
        return response()->download(file:'DocxTemplate/Usulan SK & ST - '. $request->permohonan_id. '.docx')->deleteFileAfterSend(shouldDelete:true);
    }

    public function cetakPenyampaianJadwalPenilaian(Request $request){

    }

}
