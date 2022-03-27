<?php

namespace App\Http\Controllers;

use App\Models\risalah;
use App\Models\permohonan;
use Illuminate\Http\Request;
use App\Models\penetapanLelang;
use App\Models\permohonanLelang;
use App\Models\suratPersetujuan;
use App\Models\permohonanPenilaian;
use PhpOffice\PhpWord\Element\Table;
use App\Models\pemberitahuanPenilaian;
use PhpOffice\PhpWord\SimpleType\TblWidth;

class cetakDokumen extends Controller
{
    public function cetakPermohonanSKSTPenilai(Request $request)
    {
        switch ($request->action) {
            case 'SKST':
                $a = permohonanPenilaian::all()->find($request->permohonan_id);
                if (isset($request->nama)) {
                    foreach ($request->nama as $key) {
                        $c = permohonanPenilaian::all()->find($request->permohonan_id)->users->find($key);
                        if (!isset($c)) {
                            permohonanPenilaian::all()->find($request->permohonan_id)->users()->attach($key);
                        }
                    }
                }

                $b = permohonanPenilaian::all()->find($request->permohonan_id);

                $date = date_create($a->tanggalSurat);
                $tglSurat = date_format($date, "d");
                $blnSurat = date_format($date, "m");
                $tahunSurat = date_format($date, "Y");
                switch ($blnSurat) {
                    case '1':
                        $blnSurat = 'Januari';
                        break;
                    case '2':
                        $blnSurat = 'Februari';
                        break;
                    case '3':
                        $blnSurat = 'Maret';
                        break;
                    case '4':
                        $blnSurat = 'April';
                        break;
                    case '5':
                        $blnSurat = 'Mei';
                        break;
                    case '6':
                        $blnSurat = 'Juni';
                        break;
                    case '7':
                        $blnSurat = 'Juli';
                        break;
                    case '8':
                        $blnSurat = 'Agustus';
                        break;
                    case '9':
                        $blnSurat = 'September';
                        break;
                    case '10':
                        $blnSurat = 'Oktober';
                        break;
                    case '11':
                        $blnSurat = 'November';
                        break;
                    case '12':
                        $blnSurat = 'Desember';
                        break;
                }
                $tanggalsurat = $tglSurat  . ' ' . $blnSurat . ' ' . $tahunSurat;

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

                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/PermohonanSK-STPenilai.docx');
                $templateProcessor->setValue('nomorSurat', $a->nomorSurat);
                $templateProcessor->setValue('tanggalSurat', $tanggalsurat);
                $templateProcessor->setValue('hal', $a->hal);
                $templateProcessor->setValue('pemohon', $a->permohonan->satuanKerja->namaSatker);
                $templateProcessor->setValue('lokasi', $request->lokasi);

                if ($request->tanggalMulaiSurvei === $request->tanggalSelesaiSurvei) {
                    $templateProcessor->setValue('tanggalSurvei', $tanggalMulaiSurvei);
                } else {
                    if ($tahunMulaiSurvei === $tahunSelesaiSurvei && $blnMulaiSurvei === $blnSelesaiSurvei) {
                        $survei = $tglMulaiSurvei . ' s.d. ' . $tglSelesaiSurvei . ' ' . $blnSelesaiSurvei . ' ' . $tahunSelesaiSurvei;
                        $templateProcessor->setValue('tanggalSurvei', $survei);
                    } else {
                        if ($tahunMulaiSurvei === $tahunSelesaiSurvei) {
                            $survei = $tglMulaiSurvei . ' ' . $blnMulaiSurvei . ' s.d. ' . $tglSelesaiSurvei . ' ' . $blnSelesaiSurvei . ' ' . $tahunSelesaiSurvei;
                            $templateProcessor->setValue('tanggalSurvei', $survei);
                        } else {
                            $survei = $tglMulaiSurvei . ' ' . $blnMulaiSurvei . ' ' . $tahunMulaiSurvei . ' s.d. ' . $tglSelesaiSurvei . ' ' . $blnSelesaiSurvei . ' ' . $tahunSelesaiSurvei;
                            $templateProcessor->setValue('tanggalSurvei', $survei);
                        }
                    }
                }

                $templateProcessor->cloneRow('anggotaTim', $b->users->count());
                $i = 1;
                $c = $b->users()->orderByDesc('permohonan_penilaian_user.created_at')->get();
                foreach ($c as $user) {
                    $anggotaTim = 'anggotaTim#' . $i;
                    $NIP = 'NIP#' . $i;
                    $jabatan = 'jabatan#' . $i;
                    $pangkat = 'pangkat#' . $i;
                    $nomor = 'nomor#' . $i;

                    $templateProcessor->setValue($anggotaTim, $user->nama);
                    $templateProcessor->setValue($jabatan, $user->jabatans->namaJabatan);
                    $templateProcessor->setValue($pangkat, $user->pangkatGolongan);
                    $templateProcessor->setValue($NIP, $user->NIP);
                    $templateProcessor->setValue($nomor, $i);
                    $i++;
                }

                $templateProcessor->saveAs('DocxTemplate/Usulan SK & ST - ' . $request->permohonan_id . '.docx');
                return response()->download(file: 'DocxTemplate/Usulan SK & ST - ' . $request->permohonan_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                break;
            case 'Jadwal':
                $a = permohonanPenilaian::all()->find($request->permohonan_id);
                if (isset($request->nama)) {
                    foreach ($request->nama as $key) {
                        $c = permohonanPenilaian::all()->find($request->permohonan_id)->users->find($key);
                        if (!isset($c)) {
                            permohonanPenilaian::all()->find($request->permohonan_id)->users()->attach($key);
                        }
                    }
                }

                $b = permohonanPenilaian::all()->find($request->permohonan_id);

                $date = date_create($a->tanggalSurat);
                $tglSurat = date_format($date, "d");
                $blnSurat = date_format($date, "m");
                $tahunSurat = date_format($date, "Y");
                switch ($blnSurat) {
                    case '1':
                        $blnSurat = 'Januari';
                        break;
                    case '2':
                        $blnSurat = 'Februari';
                        break;
                    case '3':
                        $blnSurat = 'Maret';
                        break;
                    case '4':
                        $blnSurat = 'April';
                        break;
                    case '5':
                        $blnSurat = 'Mei';
                        break;
                    case '6':
                        $blnSurat = 'Juni';
                        break;
                    case '7':
                        $blnSurat = 'Juli';
                        break;
                    case '8':
                        $blnSurat = 'Agustus';
                        break;
                    case '9':
                        $blnSurat = 'September';
                        break;
                    case '10':
                        $blnSurat = 'Oktober';
                        break;
                    case '11':
                        $blnSurat = 'November';
                        break;
                    case '12':
                        $blnSurat = 'Desember';
                        break;
                }
                $tanggalsurat = $tglSurat  . ' ' . $blnSurat . ' ' . $tahunSurat;

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

                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/PenyampaianJadwalPenilaian.docx');
                $templateProcessor->setValue('nomorSurat', $a->nomorSurat);
                $templateProcessor->setValue('tanggalSurat', $tanggalsurat);
                $templateProcessor->setValue('hal', $a->hal);
                $templateProcessor->setValue('pemohon', $a->permohonan->satuanKerja->namaSatker);
                $templateProcessor->setValue('lokasi', $request->lokasi);

                if ($request->tanggalMulaiSurvei === $request->tanggalSelesaiSurvei) {
                    $templateProcessor->setValue('tanggalSurvei', $tanggalMulaiSurvei);
                } else {
                    if ($tahunMulaiSurvei === $tahunSelesaiSurvei && $blnMulaiSurvei === $blnSelesaiSurvei) {
                        $survei = $tglMulaiSurvei . ' s.d. ' . $tglSelesaiSurvei . ' ' . $blnSelesaiSurvei . ' ' . $tahunSelesaiSurvei;
                        $templateProcessor->setValue('tanggalSurvei', $survei);
                    } else {
                        if ($tahunMulaiSurvei === $tahunSelesaiSurvei) {
                            $survei = $tglMulaiSurvei . ' ' . $blnMulaiSurvei . ' s.d. ' . $tglSelesaiSurvei . ' ' . $blnSelesaiSurvei . ' ' . $tahunSelesaiSurvei;
                            $templateProcessor->setValue('tanggalSurvei', $survei);
                        } else {
                            $survei = $tglMulaiSurvei . ' ' . $blnMulaiSurvei . ' ' . $tahunMulaiSurvei . ' s.d. ' . $tglSelesaiSurvei . ' ' . $blnSelesaiSurvei . ' ' . $tahunSelesaiSurvei;
                            $templateProcessor->setValue('tanggalSurvei', $survei);
                        }
                    }
                }

                $templateProcessor->cloneRow('anggotaTim', $b->users->count());
                $i = 1;
                $c = $b->users()->orderByDesc('permohonan_penilaian_user.created_at')->get();
                foreach ($c as $user) {
                    $anggotaTim = 'anggotaTim#' . $i;
                    $NIP = 'NIP#' . $i;
                    $nomor = 'nomor#' . $i;
                    $jabatan = 'jabatan#' . $i;
                    $pangkat = 'pangkat#' . $i;

                    $templateProcessor->setValue($anggotaTim, $user->nama);
                    $templateProcessor->setValue($NIP, $user->NIP);
                    $templateProcessor->setValue($jabatan, $user->jabatans->namaJabatan);
                    $templateProcessor->setValue($pangkat, $user->pangkatGolongan);
                    $templateProcessor->setValue($nomor, $i);
                    $i++;
                }

                $templateProcessor->saveAs('DocxTemplate/Penyampaian Jadwal Penilaian - ' . $request->permohonan_id . '.docx');
                return response()->download(file: 'DocxTemplate/Penyampaian Jadwal Penilaian - ' . $request->permohonan_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                break;
            case 'penyampaianLaporan':
                $pemberitahuanPenilaian = pemberitahuanPenilaian::all()->find($request->pemberitahuan_penilaian_id);
                $satuanKerja = $pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker;
                $date = date_create($pemberitahuanPenilaian->permohonanPenilaian->tanggalSurat);
                $tglSurat = date_format($date, "d");
                $blnSurat = date_format($date, "m");
                $tahunSurat = date_format($date, "Y");
                switch ($blnSurat) {
                    case '1':
                        $blnSurat = 'Januari';
                        break;
                    case '2':
                        $blnSurat = 'Februari';
                        break;
                    case '3':
                        $blnSurat = 'Maret';
                        break;
                    case '4':
                        $blnSurat = 'April';
                        break;
                    case '5':
                        $blnSurat = 'Mei';
                        break;
                    case '6':
                        $blnSurat = 'Juni';
                        break;
                    case '7':
                        $blnSurat = 'Juli';
                        break;
                    case '8':
                        $blnSurat = 'Agustus';
                        break;
                    case '9':
                        $blnSurat = 'September';
                        break;
                    case '10':
                        $blnSurat = 'Oktober';
                        break;
                    case '11':
                        $blnSurat = 'November';
                        break;
                    case '12':
                        $blnSurat = 'Desember';
                        break;
                }
                $tanggalsurat = $tglSurat  . ' ' . $blnSurat . ' ' . $tahunSurat;
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/PenyampaianLaporan.docx');
                $templateProcessor->setValue('nomorSurat', $pemberitahuanPenilaian->permohonanPenilaian->nomorSurat);
                $templateProcessor->setValue('tanggalSurat', $tanggalsurat);
                $templateProcessor->setValue('hal', $pemberitahuanPenilaian->permohonanPenilaian->hal);
                $templateProcessor->setValue('pemohon', $satuanKerja);
                $templateProcessor->cloneRow('no', $pemberitahuanPenilaian->laporanPenilaian->count());
                $i = 1;
                foreach ($pemberitahuanPenilaian->laporanPenilaian as $key) {
                    $nomor = 'nomor#' . $i;
                    $tanggal = 'tanggal#' . $i;
                    $no = 'no#' . $i;
                    $nilaiWajar = 'nilaiWajar#' . $i;
                    $satker = 'satker#' . $i;
                    $date = date_create($key->tanggalLaporan);
                    $tglLaporan = date_format($date, "d");
                    $blnLaporan = date_format($date, "m");
                    $tahunLaporan = date_format($date, "Y");
                    switch ($blnLaporan) {
                        case '1':
                            $blnLaporan = 'Januari';
                            break;
                        case '2':
                            $blnLaporan = 'Februari';
                            break;
                        case '3':
                            $blnLaporan = 'Maret';
                            break;
                        case '4':
                            $blnLaporan = 'April';
                            break;
                        case '5':
                            $blnLaporan = 'Mei';
                            break;
                        case '6':
                            $blnLaporan = 'Juni';
                            break;
                        case '7':
                            $blnLaporan = 'Juli';
                            break;
                        case '8':
                            $blnLaporan = 'Agustus';
                            break;
                        case '9':
                            $blnLaporan = 'September';
                            break;
                        case '10':
                            $blnLaporan = 'Oktober';
                            break;
                        case '11':
                            $blnLaporan = 'November';
                            break;
                        case '12':
                            $blnLaporan = 'Desember';
                            break;
                    }
                    $tanggalLaporan = $tglLaporan  . ' ' . $blnLaporan . ' ' . $tahunLaporan;
                    $templateProcessor->setValue($nomor, $key->nomorLaporan);
                    $templateProcessor->setValue($tanggal, $tanggalLaporan);

                    $money = number_format($key->barang->sum('nilaiWajar'), 2, ',', '.');
                    $templateProcessor->setValue($nilaiWajar, $money);
                    $templateProcessor->setValue($no, $i);
                    $i++;
                }

                $templateProcessor->saveAs('DocxTemplate/Penyampaian Laporan - ' . $request->pemberitahuan_penilaian_id . '.docx');
                return response()->download(file: 'DocxTemplate/Penyampaian Laporan - ' . $request->pemberitahuan_penilaian_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                break;
            case 'kajiulang':
                $pemberitahuanPenilaian = pemberitahuanPenilaian::all()->find($request->pemberitahuan_penilaian_id);
                $satuanKerja = $pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker;
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/KajiUlang.docx');

                $templateProcessor->cloneRow('no', $pemberitahuanPenilaian->laporanPenilaian->count());
                $i = 1;
                foreach ($pemberitahuanPenilaian->laporanPenilaian as $key) {
                    $nomor = 'nomor#' . $i;
                    $tanggal = 'tanggal#' . $i;
                    $no = 'no#' . $i;
                    $nilaiWajar = 'nilaiWajar#' . $i;
                    $satker = 'satker#' . $i;
                    $date = date_create($key->tanggalLaporan);
                    $tglLaporan = date_format($date, "d");
                    $blnLaporan = date_format($date, "m");
                    $tahunLaporan = date_format($date, "Y");
                    switch ($blnLaporan) {
                        case '1':
                            $blnLaporan = 'Januari';
                            break;
                        case '2':
                            $blnLaporan = 'Februari';
                            break;
                        case '3':
                            $blnLaporan = 'Maret';
                            break;
                        case '4':
                            $blnLaporan = 'April';
                            break;
                        case '5':
                            $blnLaporan = 'Mei';
                            break;
                        case '6':
                            $blnLaporan = 'Juni';
                            break;
                        case '7':
                            $blnLaporan = 'Juli';
                            break;
                        case '8':
                            $blnLaporan = 'Agustus';
                            break;
                        case '9':
                            $blnLaporan = 'September';
                            break;
                        case '10':
                            $blnLaporan = 'Oktober';
                            break;
                        case '11':
                            $blnLaporan = 'November';
                            break;
                        case '12':
                            $blnLaporan = 'Desember';
                            break;
                    }
                    $tanggalLaporan = $tglLaporan  . ' ' . $blnLaporan . ' ' . $tahunLaporan;
                    $templateProcessor->setValue($nomor, $key->nomorLaporan);
                    $templateProcessor->setValue($tanggal, $tanggalLaporan);
                    $templateProcessor->setValue($no, $i);
                    $templateProcessor->setValue($satker, $satuanKerja);
                    $i++;
                }

                $templateProcessor->saveAs('DocxTemplate/Kaji Ulang - ' . $request->pemberitahuan_penilaian_id . '.docx');
                return response()->download(file: 'DocxTemplate/Kaji Ulang - ' . $request->pemberitahuan_penilaian_id . '.docx')->deleteFileAfterSend(shouldDelete: true);

                // $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/PengantarKajiUlang.docx');
                // $templateProcessor->setValue('pemohon', $satuanKerja);
                // $templateProcessor->saveAs('DocxTemplate/Pengantar Kaji Ulang - '. $request->pemberitahuan_penilaian_id. '.docx');
                // return response()->download(file:'DocxTemplate/Pengantar Kaji Ulang - '. $request->pemberitahuan_penilaian_id. '.docx')->deleteFileAfterSend(shouldDelete:true);

                break;
            case 'suratpersetujuan':
                $permohonan = permohonan::all()->find($request->permohonan_id);
                $barang = permohonan::all()->find($request->permohonan_id)->barang;
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/LampiranSuratPersetujuan.docx');
                $templateProcessor->setValue('kementerian', $permohonan->satuanKerja->kementerian->namaKL);
                $templateProcessor->setValue('satker', $permohonan->satuanKerja->namaSatker);
                $templateProcessor->setValue('jumlahPerolehan', number_format($barang->sum('nilaiPerolehan'), 2, ',', '.'));
                $templateProcessor->setValue('jumlahLimit', number_format($barang->sum('nilaiLimit'), 2, ',', '.'));
                $templateProcessor->cloneRow('no', $barang->count());
                $i = 1;
                foreach ($barang as $key) {
                    $no = 'no#' . $i;
                    $kodeBarang = 'kodeBarang#' . $i;
                    $NUP = 'NUP#' . $i;
                    $jenisBMN = 'jenisBMN#' . $i;
                    $merktipe = 'merktipe#' . $i;
                    $nomorPolisi = 'nomorPolisi#' . $i;
                    $nomorRangka = 'nomorRangka#' . $i;
                    $nomorMesin = 'nomorMesin#' . $i;
                    $tahunPerolehan = 'tahunPerolehan#' . $i;
                    $nilaiPerolehan = 'nilaiPerolehan#' . $i;
                    $nilaiLimit = 'nilaiLimit#' . $i;
                    $keterangan = 'keterangan#' . $i;
                    $valueNilaiPerolehan = number_format($key->nilaiPerolehan, 2, ',', '.');
                    $valueNilaiLimit = number_format($key->nilaiLimit, 2, ',', '.');

                    if (isset($key->nomorPolisi)) {
                        $valueNomorPolisi = '<w:br/>Nomor Polisi ' . $key->nomorPolisi;
                    } else {
                        $valueNomorPolisi = '';
                    }

                    if (isset($key->nomorRangka)) {
                        $valueNomorRangka = '<w:br/>Nomor Rangka ' . $key->nomorRangka;
                    } else {
                        $valueNomorRangka = '';
                    }

                    if (isset($key->nomorMesin)) {
                        $valueNomorMesin = '<w:br/>Nomor Mesin ' . $key->nomorMesin;
                    } else {
                        $valueNomorMesin = '';
                    }

                    $templateProcessor->setValue($no, $i);
                    $templateProcessor->setValue($kodeBarang, $key->kodeBarang);
                    $templateProcessor->setValue($NUP, $key->NUP);
                    $templateProcessor->setValue($jenisBMN, $key->kodeBarangs->namaBarang);
                    $templateProcessor->setValue($merktipe, $key->merkType);
                    $templateProcessor->setValue($nomorPolisi, $valueNomorPolisi);
                    $templateProcessor->setValue($nomorRangka, $valueNomorRangka);
                    $templateProcessor->setValue($nomorMesin, $valueNomorMesin);
                    $templateProcessor->setValue($tahunPerolehan, $key->tahunPerolehan);
                    $templateProcessor->setValue($nilaiPerolehan, $valueNilaiPerolehan);
                    $templateProcessor->setValue($nilaiLimit, $valueNilaiLimit);
                    $templateProcessor->setValue($keterangan, $key->keterangan);
                    $i++;
                }
                $templateProcessor->saveAs('DocxTemplate/Lampiran Surat Persetujuan - ' . $request->permohonan_id . '.docx');
                return response()->download(file: 'DocxTemplate/Lampiran Surat Persetujuan - ' . $request->permohonan_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                break;
            case 'permohonanPenilaian':
                $permohonan = permohonan::find($request->permohonan_id);
                $date = date_create($permohonan->tanggalSurat);
                $tglSurat = date_format($date, "d");
                $blnSurat = date_format($date, "m");
                $tahunSurat = date_format($date, "Y");
                switch ($blnSurat) {
                    case '1':
                        $blnSurat = 'Januari';
                        break;
                    case '2':
                        $blnSurat = 'Februari';
                        break;
                    case '3':
                        $blnSurat = 'Maret';
                        break;
                    case '4':
                        $blnSurat = 'April';
                        break;
                    case '5':
                        $blnSurat = 'Mei';
                        break;
                    case '6':
                        $blnSurat = 'Juni';
                        break;
                    case '7':
                        $blnSurat = 'Juli';
                        break;
                    case '8':
                        $blnSurat = 'Agustus';
                        break;
                    case '9':
                        $blnSurat = 'September';
                        break;
                    case '10':
                        $blnSurat = 'Oktober';
                        break;
                    case '11':
                        $blnSurat = 'November';
                        break;
                    case '12':
                        $blnSurat = 'Desember';
                        break;
                }
                $tanggalsurat = $tglSurat  . ' ' . $blnSurat . ' ' . $tahunSurat;
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/PermohonanPenilaian.docx');
                $templateProcessor->setValue('nomorSurat', $permohonan->nomorSurat);
                $templateProcessor->setValue('tanggalSurat', $tanggalsurat);
                $templateProcessor->setValue('hal', $permohonan->hal);
                $templateProcessor->setValue('kementerian', $permohonan->satuanKerja->kementerian->namaKL);
                $templateProcessor->setValue('satker', $permohonan->satuanKerja->namaSatker);
                $templateProcessor->saveAs('DocxTemplate/Permohonan Penilaian - ' . $request->permohonan_id . '.docx');
                return response()->download(file: 'DocxTemplate/Permohonan Penilaian - ' . $request->permohonan_id . '.docx')->deleteFileAfterSend(shouldDelete: true);                
                break;
            case 'potensiLelang':
                $suratPersetujuan = suratPersetujuan::find($request->surat_persetujuan_id);
                $date = date_create($suratPersetujuan->tanggalSurat);
                $tglSurat = date_format($date, "d");
                $blnSurat = date_format($date, "m");
                $tahunSurat = date_format($date, "Y");
                switch ($blnSurat) {
                    case '1':
                        $blnSurat = 'Januari';
                        break;
                    case '2':
                        $blnSurat = 'Februari';
                        break;
                    case '3':
                        $blnSurat = 'Maret';
                        break;
                    case '4':
                        $blnSurat = 'April';
                        break;
                    case '5':
                        $blnSurat = 'Mei';
                        break;
                    case '6':
                        $blnSurat = 'Juni';
                        break;
                    case '7':
                        $blnSurat = 'Juli';
                        break;
                    case '8':
                        $blnSurat = 'Agustus';
                        break;
                    case '9':
                        $blnSurat = 'September';
                        break;
                    case '10':
                        $blnSurat = 'Oktober';
                        break;
                    case '11':
                        $blnSurat = 'November';
                        break;
                    case '12':
                        $blnSurat = 'Desember';
                        break;
                }
                $tanggalsurat = $tglSurat  . ' ' . $blnSurat . ' ' . $tahunSurat;
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/penggalianPotensiLelang.docx');
                $templateProcessor->setValue('nomorSurat', $suratPersetujuan->nomorSurat);
                $templateProcessor->setValue('tanggalSurat', $tanggalsurat);
                $templateProcessor->setValue('hal', $suratPersetujuan->hal);
                $templateProcessor->setValue('kementerian', $suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->kementerian->namaKL);
                $templateProcessor->setValue('satker', $suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker);
                $templateProcessor->saveAs('DocxTemplate/penggalian Potensi Lelang - ' . $request->surat_persetujuan_id . '.docx');
                return response()->download(file: 'DocxTemplate/penggalian Potensi Lelang - ' . $request->surat_persetujuan_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                break;
            case 'penetapanLelangOpen':
                $permohonanLelang = permohonanLelang::find($request->permohonan_lelang_id);
                $date = date_create($permohonanLelang->tanggalSurat);
                $tglSurat = date_format($date, "d");
                $blnSurat = date_format($date, "m");
                $tahunSurat = date_format($date, "Y");
                switch ($blnSurat) {
                    case '1':
                        $blnSurat = 'Januari';
                        break;
                    case '2':
                        $blnSurat = 'Februari';
                        break;
                    case '3':
                        $blnSurat = 'Maret';
                        break;
                    case '4':
                        $blnSurat = 'April';
                        break;
                    case '5':
                        $blnSurat = 'Mei';
                        break;
                    case '6':
                        $blnSurat = 'Juni';
                        break;
                    case '7':
                        $blnSurat = 'Juli';
                        break;
                    case '8':
                        $blnSurat = 'Agustus';
                        break;
                    case '9':
                        $blnSurat = 'September';
                        break;
                    case '10':
                        $blnSurat = 'Oktober';
                        break;
                    case '11':
                        $blnSurat = 'November';
                        break;
                    case '12':
                        $blnSurat = 'Desember';
                        break;
                }
                $tanggalsurat = $tglSurat  . ' ' . $blnSurat . ' ' . $tahunSurat;

                $dateLelang = date_create($request->tanggalLelang);
                $tglLelang = date_format($dateLelang, "d");
                $blnLelang = date_format($dateLelang, "m");
                $tahunLelang = date_format($dateLelang, "Y");
                switch ($blnLelang) {
                    case '1':
                        $blnLelang = 'Januari';
                        break;
                    case '2':
                        $blnLelang = 'Februari';
                        break;
                    case '3':
                        $blnLelang = 'Maret';
                        break;
                    case '4':
                        $blnLelang = 'April';
                        break;
                    case '5':
                        $blnLelang = 'Mei';
                        break;
                    case '6':
                        $blnLelang = 'Juni';
                        break;
                    case '7':
                        $blnLelang = 'Juli';
                        break;
                    case '8':
                        $blnLelang = 'Agustus';
                        break;
                    case '9':
                        $blnLelang = 'September';
                        break;
                    case '10':
                        $blnLelang = 'Oktober';
                        break;
                    case '11':
                        $blnLelang = 'November';
                        break;
                    case '12':
                        $blnLelang = 'Desember';
                        break;
                }
                $tanggalLelang = $tglLelang  . ' ' . $blnLelang . ' ' . $tahunLelang;

                $hariLelang = date_format($dateLelang, "l");

                switch ($hariLelang) {
                    case 'Sunday':
                        $hariLelang = 'Minggu';
                        break;
                    case 'Monday':
                        $hariLelang = 'Senin';
                        break;
                    case 'Tuesday':
                        $hariLelang = 'Selasa';
                        break;
                    case 'Wednesday':
                        $hariLelang = 'Rabu';
                        break;
                    case 'Thursday':
                        $hariLelang = 'Kamis';
                        break;
                    case 'Friday':
                        $hariLelang = 'Jumat';
                        break;
                    case 'Saturday':
                        $hariLelang = 'Sabtu';
                        break;
                }

                $datePengumuman = date_create($request->tanggalPengumuman);
                $tglPengumuman = date_format($datePengumuman, "d");
                $blnPengumuman = date_format($datePengumuman, "m");
                $tahunPengumuman = date_format($datePengumuman, "Y");
                switch ($blnPengumuman) {
                    case '1':
                        $blnPengumuman = 'Januari';
                        break;
                    case '2':
                        $blnPengumuman = 'Februari';
                        break;
                    case '3':
                        $blnPengumuman = 'Maret';
                        break;
                    case '4':
                        $blnPengumuman = 'April';
                        break;
                    case '5':
                        $blnPengumuman = 'Mei';
                        break;
                    case '6':
                        $blnPengumuman = 'Juni';
                        break;
                    case '7':
                        $blnPengumuman = 'Juli';
                        break;
                    case '8':
                        $blnPengumuman = 'Agustus';
                        break;
                    case '9':
                        $blnPengumuman = 'September';
                        break;
                    case '10':
                        $blnPengumuman = 'Oktober';
                        break;
                    case '11':
                        $blnPengumuman = 'November';
                        break;
                    case '12':
                        $blnPengumuman = 'Desember';
                        break;
                }
                $tanggalPengumuman = $tglPengumuman  . ' ' . $blnPengumuman . ' ' . $tahunPengumuman;

                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/penetapanJadwalLelangOB.docx');
                $templateProcessor->setValue('nomorSurat', $permohonanLelang->nomorSurat);
                $templateProcessor->setValue('hal', $permohonanLelang->hal);
                $templateProcessor->setValue('tanggalSurat', $tanggalsurat);
                $templateProcessor->setValue('tanggalLelang', $tanggalLelang);
                $templateProcessor->setValue('hariLelang', $hariLelang);
                $templateProcessor->setValue('tanggalPengumuman', $tanggalPengumuman);
                $templateProcessor->setValue('satker', $permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker);
                $templateProcessor->setValue('lokasi', $request->lokasi);
                $templateProcessor->setValue('jamAwalPenawaran', $request->jamAwalPenawaran);
                $templateProcessor->setValue('menitAwalPenawaran', $request->menitAwalPenawaran);
                $templateProcessor->setValue('jamAkhirPenawaran', $request->jamAkhirPenawaran);
                $templateProcessor->setValue('menitAkhirPenawaran', $request->menitAkhirPenawaran);
                $templateProcessor->setValue('jamAwalPenawaranWIB', $request->jamAwalPenawaran-2);
                $templateProcessor->setValue('jamAkhirPenawaranWIB', $request->jamAkhirPenawaran-2);

                $templateProcessor->saveAs('DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx');
                return response()->download(file: 'DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx')->deleteFileAfterSend(shouldDelete: true);

                
                break;
            case 'penetapanLelangClosed':
                $permohonanLelang = permohonanLelang::find($request->permohonan_lelang_id);
                $date = date_create($permohonanLelang->tanggalSurat);
                $tglSurat = date_format($date, "d");
                $blnSurat = date_format($date, "m");
                $tahunSurat = date_format($date, "Y");
                switch ($blnSurat) {
                    case '1':
                        $blnSurat = 'Januari';
                        break;
                    case '2':
                        $blnSurat = 'Februari';
                        break;
                    case '3':
                        $blnSurat = 'Maret';
                        break;
                    case '4':
                        $blnSurat = 'April';
                        break;
                    case '5':
                        $blnSurat = 'Mei';
                        break;
                    case '6':
                        $blnSurat = 'Juni';
                        break;
                    case '7':
                        $blnSurat = 'Juli';
                        break;
                    case '8':
                        $blnSurat = 'Agustus';
                        break;
                    case '9':
                        $blnSurat = 'September';
                        break;
                    case '10':
                        $blnSurat = 'Oktober';
                        break;
                    case '11':
                        $blnSurat = 'November';
                        break;
                    case '12':
                        $blnSurat = 'Desember';
                        break;
                }
                $tanggalsurat = $tglSurat  . ' ' . $blnSurat . ' ' . $tahunSurat;

                $dateLelang = date_create($request->tanggalLelang);
                $tglLelang = date_format($dateLelang, "d");
                $blnLelang = date_format($dateLelang, "m");
                $tahunLelang = date_format($dateLelang, "Y");
                switch ($blnLelang) {
                    case '1':
                        $blnLelang = 'Januari';
                        break;
                    case '2':
                        $blnLelang = 'Februari';
                        break;
                    case '3':
                        $blnLelang = 'Maret';
                        break;
                    case '4':
                        $blnLelang = 'April';
                        break;
                    case '5':
                        $blnLelang = 'Mei';
                        break;
                    case '6':
                        $blnLelang = 'Juni';
                        break;
                    case '7':
                        $blnLelang = 'Juli';
                        break;
                    case '8':
                        $blnLelang = 'Agustus';
                        break;
                    case '9':
                        $blnLelang = 'September';
                        break;
                    case '10':
                        $blnLelang = 'Oktober';
                        break;
                    case '11':
                        $blnLelang = 'November';
                        break;
                    case '12':
                        $blnLelang = 'Desember';
                        break;
                }
                $tanggalLelang = $tglLelang  . ' ' . $blnLelang . ' ' . $tahunLelang;

                $hariLelang = date_format($dateLelang, "l");

                switch ($hariLelang) {
                    case 'Sunday':
                        $hariLelang = 'Minggu';
                        break;
                    case 'Monday':
                        $hariLelang = 'Senin';
                        break;
                    case 'Tuesday':
                        $hariLelang = 'Selasa';
                        break;
                    case 'Wednesday':
                        $hariLelang = 'Rabu';
                        break;
                    case 'Thursday':
                        $hariLelang = 'Kamis';
                        break;
                    case 'Friday':
                        $hariLelang = 'Jumat';
                        break;
                    case 'Saturday':
                        $hariLelang = 'Sabtu';
                        break;
                }

                $datePengumuman = date_create($request->tanggalPengumuman);
                $tglPengumuman = date_format($datePengumuman, "d");
                $blnPengumuman = date_format($datePengumuman, "m");
                $tahunPengumuman = date_format($datePengumuman, "Y");
                switch ($blnPengumuman) {
                    case '1':
                        $blnPengumuman = 'Januari';
                        break;
                    case '2':
                        $blnPengumuman = 'Februari';
                        break;
                    case '3':
                        $blnPengumuman = 'Maret';
                        break;
                    case '4':
                        $blnPengumuman = 'April';
                        break;
                    case '5':
                        $blnPengumuman = 'Mei';
                        break;
                    case '6':
                        $blnPengumuman = 'Juni';
                        break;
                    case '7':
                        $blnPengumuman = 'Juli';
                        break;
                    case '8':
                        $blnPengumuman = 'Agustus';
                        break;
                    case '9':
                        $blnPengumuman = 'September';
                        break;
                    case '10':
                        $blnPengumuman = 'Oktober';
                        break;
                    case '11':
                        $blnPengumuman = 'November';
                        break;
                    case '12':
                        $blnPengumuman = 'Desember';
                        break;
                }
                $tanggalPengumuman = $tglPengumuman  . ' ' . $blnPengumuman . ' ' . $tahunPengumuman;

                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/penetapanJadwalLelangCB.docx');
                $templateProcessor->setValue('nomorSurat', $permohonanLelang->nomorSurat);
                $templateProcessor->setValue('hal', $permohonanLelang->hal);
                $templateProcessor->setValue('tanggalSurat', $tanggalsurat);
                $templateProcessor->setValue('tanggalLelang', $tanggalLelang);
                $templateProcessor->setValue('hariLelang', $hariLelang);
                $templateProcessor->setValue('tanggalPengumuman', $tanggalPengumuman);
                $templateProcessor->setValue('satker', $permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker);
                $templateProcessor->setValue('lokasi', $request->lokasi);
                $templateProcessor->setValue('jamAkhirPenawaran', $request->jamAkhirPenawaran);
                $templateProcessor->setValue('menitAkhirPenawaran', $request->menitAkhirPenawaran);
                $templateProcessor->setValue('jamAkhirPenawaranWIB', $request->jamAkhirPenawaran-2);

                $templateProcessor->saveAs('DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx');
                return response()->download(file: 'DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                break;
            case 'salinanRisalah':
                $penetapanLelang = penetapanLelang::find($request->penetapan_lelang_id);
                function numberTowords($num){
                    $ones = array(
                        0 =>"nol",
                        1 => "satu",
                        2 => "dua",
                        3 => "tiga",
                        4 => "empat",
                        5 => "lima",
                        6 => "enam",
                        7 => "tujuh",
                        8 => "delapan",
                        9 => "sembilan",
                        10 => "sepuluh",
                        11 => "sebelas",
                        12 => "dua belas",
                        13 => "tiga belas",
                        14 => "empat belas",
                        15 => "lima belas",
                        16 => "enam belas",
                        17 => "tujuh belas",
                        18 => "delapan belas",
                        19 => "sembilan belas",
                    );
                    $tens = array( 
                        0 => "nol",
                        1 => "sepuluh",
                        2 => "dua puluh",
                        3 => "tiga puluh", 
                        4 => "empat puluh", 
                        5 => "lima puluh", 
                        6 => "enam puluh", 
                        7 => "tujuh puluh", 
                        8 => "delapan puluh", 
                        9 => "sembilan puluh" 
                    ); 
                    $hundreds = array( 
                        "ratus", 
                        "ribu", 
                        "juta", 
                        "milyar", 
                        "triliun", 
                        "QUARDRILLION" 
                    ); /*limit t quadrillion */
                    $num = number_format($num,2,".",","); 
                    $num_arr = explode(".",$num); 
                    $wholenum = $num_arr[0]; 
                    $decnum = $num_arr[1]; 
                    $whole_arr = array_reverse(explode(",",$wholenum)); 
                    krsort($whole_arr,1); 
                    $rettxt = ""; 
                    foreach($whole_arr as $key => $i){
                        while(substr($i,0,1)=="0")
                            $i=substr($i,1,5);
                        if($key == "0"){
                            if($i){
                                if($i < 20){ 
                                    /* echo "getting:".$i; */
                                    $rettxt .= $ones[$i]; 
                                }elseif($i < 100){ 
                                    if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
                                    if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
                                }else{
                                    if(substr($i,0,1)=="1") $rettxt .= "seratus";; 
                                    if(substr($i,0,1)!="0" && substr($i,0,1)!="1") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0];
                                    if(substr($i,1,1)=="1"){
                                        $rettxt .= " ".$ones[substr($i,1,2)];
                                    }else{
                                        if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
                                        if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
                                    } 
                                } 
                            }
                        }
            
                        if($key == "1"){
                            if($i){
                                if($i == "1"){
                                    $rettxt .= "seribu ";
                                }elseif($i < 20 && $i>1){ 
                                    /* echo "getting:".$i; */
                                    $rettxt .= $ones[$i]; 
                                }elseif($i < 100){ 
                                    if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
                                    if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
                                }else{
                                    if(substr($i,0,1)=="1") $rettxt .= "seratus";; 
                                    if(substr($i,0,1)!="0" && substr($i,0,1)!="1") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
                                    if(substr($i,1,1)=="1"){
                                        $rettxt .= " ".$ones[substr($i,1,2)];
                                    }else{
                                        if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
                                        if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
                                    }  
                                } 
                                if($i > "1"){
                                    $rettxt .= " ".$hundreds[$key]." ";
                                }
                            }
                        }
            
                        if($key > "1"){
                            if($i){
                                if($i < 20	){ 
                                    /* echo "getting:".$i; */
                                    $rettxt .= $ones[$i]; 
                                }elseif($i < 100){ 
                                    if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
                                    if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
                                }else{
                                    if(substr($i,0,1)=="1") $rettxt .= "seratus";; 
                                    if(substr($i,0,1)!="0" && substr($i,0,1)!="1") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
                                    if(substr($i,1,1)=="1"){
                                        $rettxt .= " ".$ones[substr($i,1,2)];
                                    }else{
                                        if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
                                        if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
                                    }   
                                } 
                                    $rettxt .= " ".$hundreds[$key]." ";
                            }
                            }
                    }
                    if($decnum > 0){
                        $rettxt .= " and ";
                        if($decnum < 20){
                            $rettxt .= $ones[$decnum];
                        }elseif($decnum < 100){
                            $rettxt .= $tens[substr($decnum,0,1)];
                            $rettxt .= " ".$ones[substr($decnum,1,1)];
                        }
                    }
                    return $rettxt;
                }

                $date = date_create($penetapanLelang->tanggalSurat);
                $tglSurat = date_format($date, "d");
                $blnSurat = date_format($date, "m");
                $tahunSurat = date_format($date, "Y");
                switch ($blnSurat) {
                    case '1':
                        $blnSurat = 'Januari';
                        break;
                    case '2':
                        $blnSurat = 'Februari';
                        break;
                    case '3':
                        $blnSurat = 'Maret';
                        break;
                    case '4':
                        $blnSurat = 'April';
                        break;
                    case '5':
                        $blnSurat = 'Mei';
                        break;
                    case '6':
                        $blnSurat = 'Juni';
                        break;
                    case '7':
                        $blnSurat = 'Juli';
                        break;
                    case '8':
                        $blnSurat = 'Agustus';
                        break;
                    case '9':
                        $blnSurat = 'September';
                        break;
                    case '10':
                        $blnSurat = 'Oktober';
                        break;
                    case '11':
                        $blnSurat = 'November';
                        break;
                    case '12':
                        $blnSurat = 'Desember';
                        break;
                }
                $tanggalsurat = $tglSurat  . ' ' . $blnSurat . ' ' . $tahunSurat;

                $dateLelang = date_create($penetapanLelang->tanggalLelang);
                $tglLelang = date_format($dateLelang, "d");
                $blnLelang = date_format($dateLelang, "m");
                $tahunLelang = date_format($dateLelang, "Y");
                switch ($blnLelang) {
                    case '1':
                        $blnLelang = 'Januari';
                        break;
                    case '2':
                        $blnLelang = 'Februari';
                        break;
                    case '3':
                        $blnLelang = 'Maret';
                        break;
                    case '4':
                        $blnLelang = 'April';
                        break;
                    case '5':
                        $blnLelang = 'Mei';
                        break;
                    case '6':
                        $blnLelang = 'Juni';
                        break;
                    case '7':
                        $blnLelang = 'Juli';
                        break;
                    case '8':
                        $blnLelang = 'Agustus';
                        break;
                    case '9':
                        $blnLelang = 'September';
                        break;
                    case '10':
                        $blnLelang = 'Oktober';
                        break;
                    case '11':
                        $blnLelang = 'November';
                        break;
                    case '12':
                        $blnLelang = 'Desember';
                        break;
                }
                $tanggalLelang = $tglLelang  . ' ' . $blnLelang . ' ' . $tahunLelang;

                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/PenyampaianSalinanRL.docx');
                $templateProcessor->setValue('satker', $penetapanLelang->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker);
                $templateProcessor->setValue('tanggalLelang', $tanggalLelang);
                $templateProcessor->setValue('suratPenetapan', $penetapanLelang->nomorSurat);
                $templateProcessor->setValue('tanggalPenetapan', $tanggalsurat);
                $templateProcessor->setValue('jumlah',  ucfirst(numberTowords($penetapanLelang->risalah->count())));
                $fancyTableStyle = [
                    'borderSize'  => 4,
                    'borderColor' => '000000',
                    'layout'      => \PhpOffice\PhpWord\Style\Table::LAYOUT_FIXED,
                ];
                $font=[
                    'name'=>'Arial', 
                    'size'=>11
                ];
                $table = new Table($fancyTableStyle);
                $table->addRow();
                $table->addCell(561.25983898419, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER, ))->addText('No.',$font, array('alignment'=>\PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                $table->addCell(3685.03934686589, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER,))->addText('Nomor Risalah',$font, array('alignment'=>\PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                $table->addCell(2721.25982537789, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER,))->addText('tanggal Risalah',$font, array('alignment'=>\PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                $table->addCell(2590.86612541187, array( 'valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER,))->addText('Keterangan',$font, array('alignment'=>\PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                $i=1;
                foreach (risalah::orderBy('nomor')->get()->where('penetapan_lelang_id', $request->penetapan_lelang_id) as $key) {
                    $dateRisalah = date_create($penetapanLelang->tanggalRisalah);
                    $tglRisalah = date_format($dateRisalah, "d");
                    $blnRisalah = date_format($dateRisalah, "m");
                    $tahunRisalah = date_format($dateRisalah, "Y");
                    switch ($blnRisalah) {
                        case '1':
                            $blnRisalah = 'Januari';
                            break;
                        case '2':
                            $blnRisalah = 'Februari';
                            break;
                        case '3':
                            $blnRisalah = 'Maret';
                            break;
                        case '4':
                            $blnRisalah = 'April';
                            break;
                        case '5':
                            $blnRisalah = 'Mei';
                            break;
                        case '6':
                            $blnRisalah = 'Juni';
                            break;
                        case '7':
                            $blnRisalah = 'Juli';
                            break;
                        case '8':
                            $blnRisalah = 'Agustus';
                            break;
                        case '9':
                            $blnRisalah = 'September';
                            break;
                        case '10':
                            $blnRisalah = 'Oktober';
                            break;
                        case '11':
                            $blnRisalah = 'November';
                            break;
                        case '12':
                            $blnRisalah = 'Desember';
                            break;
                    }
                    $tanggalRisalah = $tglRisalah  . ' ' . $blnRisalah . ' ' . $tahunRisalah;
                    if ($i === 1) {
                        $vCell=[
                            'vMerge' => 'restart', 'valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER
                        ];
                    }else{
                        $vCell=[
                            'vMerge' => 'continue', 'valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER
                        ];
                    }
                    $table->addRow();
                    $table->addCell(561.25983898419, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER))->addText($i,$font, array('alignment'=>\PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                    $table->addCell(3685.03934686589, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER))->addText($key->nomor, $font);
                    $table->addCell(2721.25982537789, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER))->addText($tanggalRisalah, $font, array('alignment'=>\PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                    $table->addCell(2590.86612541187, $vCell)->addText('Disampaikan dengan hormat dan untuk dipergunakan sebagaimana mestinya',$font, array('alignment'=>\PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                    $i++;
                }
                $templateProcessor->setComplexBlock('table', $table);

                $templateProcessor->saveAs('DocxTemplate/Penyampaian Salinan RL - ' . $request->penetapan_lelang_id . '.docx');
                return response()->download(file: 'DocxTemplate/Penyampaian Salinan RL - ' . $request->penetapan_lelang_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                break;
            default:
                abort(404);
                break;
        }
    }
    public function cetakPenyampaianJadwalPenilaian(Request $request)
    {
        return $request;
    }
}
