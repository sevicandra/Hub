<?php

namespace App\Http\Controllers;

use App\Models\permohonan;
use Illuminate\Http\Request;
use App\Models\permohonanPenilaian;
use App\Models\pemberitahuanPenilaian;

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
            case 'value':
                # code...
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
