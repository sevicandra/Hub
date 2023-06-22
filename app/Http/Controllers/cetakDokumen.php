<?php

namespace App\Http\Controllers;

use App\Models\beritaAcaraSurveiLapanganPenilaian;
use App\Models\risalah;
use App\Models\permohonan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\penetapanLelang;
use App\Models\permohonanLelang;
use App\Models\suratPersetujuan;
use App\Models\permohonanPenilaian;
use PhpOffice\PhpWord\Element\Table;
use App\Models\pemberitahuanPenilaian;


class cetakDokumen extends Controller
{
    public function cetak(Request $request)
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
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/PenyampaianLaporan.docx');
                $templateProcessor->setValue('nomorSurat', $pemberitahuanPenilaian->permohonanPenilaian->nomorSurat);
                $templateProcessor->setValue('tanggalSurat', indonesiaDate($pemberitahuanPenilaian->permohonanPenilaian->tanggalSurat));
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
                    $templateProcessor->setValue($nomor, $key->nomorLaporan);
                    $templateProcessor->setValue($tanggal, indonesiaDate($key->tanggalLaporan));

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
                    $templateProcessor->setValue($nomor, $key->nomorLaporan);
                    $templateProcessor->setValue($tanggal, indonesiaDate($key->tanggalLaporan));
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

                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/PermohonanPenilaian.docx');
                $templateProcessor->setValue('nomorSurat', $permohonan->nomorSurat);
                $templateProcessor->setValue('tanggalSurat', indonesiaDate($permohonan->tanggalSurat));
                $templateProcessor->setValue('hal', $permohonan->hal);
                $templateProcessor->setValue('kementerian', $permohonan->satuanKerja->kementerian->namaKL);
                $templateProcessor->setValue('satker', $permohonan->satuanKerja->namaSatker);
                $templateProcessor->saveAs('DocxTemplate/Permohonan Penilaian - ' . $request->permohonan_id . '.docx');
                return response()->download(file: 'DocxTemplate/Permohonan Penilaian - ' . $request->permohonan_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                break;
            case 'potensiLelang':
                $suratPersetujuan = suratPersetujuan::find($request->surat_persetujuan_id);

                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/penggalianPotensiLelang.docx');
                $templateProcessor->setValue('nomorSurat', $suratPersetujuan->nomorSurat);
                $templateProcessor->setValue('tanggalSurat', indonesiaDate($suratPersetujuan->tanggalSurat));
                $templateProcessor->setValue('hal', $suratPersetujuan->hal);
                $templateProcessor->setValue('kementerian', $suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->kementerian->namaKL);
                $templateProcessor->setValue('satker', $suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker);
                $templateProcessor->setValue('jabatanPimpinan', Str::of($suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->jabatanPimpinan)->title());
                $templateProcessor->saveAs('DocxTemplate/penggalian Potensi Lelang - ' . $request->surat_persetujuan_id . '.docx');
                return response()->download(file: 'DocxTemplate/penggalian Potensi Lelang - ' . $request->surat_persetujuan_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                break;
            case 'penetapanLelangOpen':
                $permohonanLelang = permohonanLelang::find($request->permohonan_lelang_id);
                if (isset($request->tanggalPengumumanKedua)) {
                    $pengumuman = indonesiaDate($request->tanggalPengumumanPertama) . ' sebagai pengumuman lelang pertama dan tanggal ' . indonesiaDate($request->tanggalPengumumanKedua) . ' sebagai pengumuman lelang kedua';
                } else {
                    $pengumuman = indonesiaDate($request->tanggalPengumumanPertama) . ' sebagai pengumuman lelang';
                }

                switch ($permohonanLelang->jenis) {
                    case 'App\Models\suratPersetujuan':
                        $jafung = Str::ucfirst(auth()->user()->nama);
                        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/penetapanJadwalLelangOB.docx');
                        $templateProcessor->setValue('nomorSurat', $permohonanLelang->nomorSurat);
                        $templateProcessor->setValue('alamat', $request->alamat);
                        $templateProcessor->setValue('tanggalSurat', indonesiaDate($permohonanLelang->tanggalSurat));
                        $templateProcessor->setValue('tanggalLelang', indonesiaDate($request->tanggalLelang));
                        $templateProcessor->setValue('hariLelang', indonesiaDay($request->tanggalLelang));
                        $templateProcessor->setValue('tanggalPengumuman', $pengumuman);
                        $templateProcessor->setValue('satker', $permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker);
                        $templateProcessor->setValue('jabatanPimpinan', Str::of($permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->jabatanPimpinan)->title());
                        $templateProcessor->setValue('lokasi', $request->lokasi);
                        $templateProcessor->setValue('jamAwalPenawaran', $request->jamAwalPenawaran);
                        $templateProcessor->setValue('menitAwalPenawaran', $request->menitAwalPenawaran);
                        $templateProcessor->setValue('jamAkhirPenawaran', $request->jamAkhirPenawaran);
                        $templateProcessor->setValue('menitAkhirPenawaran', $request->menitAkhirPenawaran);
                        $templateProcessor->setValue('jamAwalPenawaranWIB', $request->jamAwalPenawaran - 2);
                        $templateProcessor->setValue('jamAkhirPenawaranWIB', $request->jamAkhirPenawaran - 2);
                        $templateProcessor->setValue('pelelang', Str::of($jafung)->title());
                        $templateProcessor->saveAs('DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx');
                        return response()->download(file: 'DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                        break;

                    case 'App\Models\tiket':
                        $jafung = Str::ucfirst(auth()->user()->nama);
                        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/penetapanJadwalLelangOB.docx');
                        $templateProcessor->setValue('nomorSurat', $permohonanLelang->nomorSurat);
                        $templateProcessor->setValue('alamat', $request->alamat);
                        $templateProcessor->setValue('tanggalSurat', indonesiaDate($permohonanLelang->tanggalSurat));
                        $templateProcessor->setValue('tanggalLelang', indonesiaDate($request->tanggalLelang));
                        $templateProcessor->setValue('hariLelang', indonesiaDay($request->tanggalLelang));
                        $templateProcessor->setValue('tanggalPengumuman', $pengumuman);
                        $templateProcessor->setValue('jabatanPimpinan', $permohonanLelang->pemohonLelang->pemohon);
                        $templateProcessor->setValue('lokasi', $request->lokasi);
                        $templateProcessor->setValue('jamAwalPenawaran', $request->jamAwalPenawaran);
                        $templateProcessor->setValue('menitAwalPenawaran', $request->menitAwalPenawaran);
                        $templateProcessor->setValue('jamAkhirPenawaran', $request->jamAkhirPenawaran);
                        $templateProcessor->setValue('menitAkhirPenawaran', $request->menitAkhirPenawaran);
                        $templateProcessor->setValue('jamAwalPenawaranWIB', $request->jamAwalPenawaran - 2);
                        $templateProcessor->setValue('jamAkhirPenawaranWIB', $request->jamAkhirPenawaran - 2);
                        $templateProcessor->setValue('pelelang', Str::of($jafung)->title());
                        $templateProcessor->saveAs('DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx');
                        return response()->download(file: 'DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                        break;

                    default:
                        abort(404);
                        break;
                }
                break;
            case 'penetapanLelangClosed':
                $permohonanLelang = permohonanLelang::find($request->permohonan_lelang_id);
                $permohonanLelang = permohonanLelang::find($request->permohonan_lelang_id);
                if (isset($request->tanggalPengumumanKedua)) {
                    $pengumuman = indonesiaDate($request->tanggalPengumumanPertama) . ' sebagai pengumuman lelang pertama dan tanggal ' . indonesiaDate($request->tanggalPengumumanKedua) . ' sebagai pengumuman lelang kedua';
                } else {
                    $pengumuman = indonesiaDate($request->tanggalPengumumanPertama) . ' sebagai pengumuman lelang';
                }
                switch ($permohonanLelang->jenis) {
                    case 'App\Models\suratPersetujuan':
                        $jafung = Str::ucfirst(auth()->user()->nama);
                        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/penetapanJadwalLelangCB.docx');
                        $templateProcessor->setValue('nomorSurat', $permohonanLelang->nomorSurat);
                        $templateProcessor->setValue('alamat', $request->alamat);
                        $templateProcessor->setValue('tanggalSurat', indonesiaDate($permohonanLelang->tanggalSurat));
                        $templateProcessor->setValue('tanggalLelang', indonesiaDate($request->tanggalLelang));
                        $templateProcessor->setValue('hariLelang', indonesiaDay($request->tanggalLelang));
                        $templateProcessor->setValue('tanggalPengumuman', $pengumuman);
                        $templateProcessor->setValue('satker', $permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker);
                        $templateProcessor->setValue('jabatanPimpinan', Str::of($permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->jabatanPimpinan)->title());
                        $templateProcessor->setValue('lokasi', $request->lokasi);
                        $templateProcessor->setValue('jamAkhirPenawaran', $request->jamAkhirPenawaran);
                        $templateProcessor->setValue('menitAkhirPenawaran', $request->menitAkhirPenawaran);
                        $templateProcessor->setValue('jamAkhirPenawaranWIB', $request->jamAkhirPenawaran - 2);
                        $templateProcessor->setValue('jabatan', auth()->user()->jabatans->namaJabatan);
                        $templateProcessor->setValue('pelelang', Str::of($jafung)->title());
                        $templateProcessor->saveAs('DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx');
                        return response()->download(file: 'DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                        break;

                    case 'App\Models\tiket':
                        $jafung = Str::ucfirst(auth()->user()->nama);
                        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/penetapanJadwalLelangCB.docx');
                        $templateProcessor->setValue('nomorSurat', $permohonanLelang->nomorSurat);
                        $templateProcessor->setValue('alamat', $request->alamat);
                        $templateProcessor->setValue('tanggalSurat', indonesiaDate($permohonanLelang->tanggalSurat));
                        $templateProcessor->setValue('tanggalLelang', indonesiaDate($request->tanggalLelang));
                        $templateProcessor->setValue('hariLelang', indonesiaDay($request->tanggalLelang));
                        $templateProcessor->setValue('tanggalPengumuman', $pengumuman);
                        $templateProcessor->setValue('jabatanPimpinan', $permohonanLelang->pemohonLelang->pemohon);
                        $templateProcessor->setValue('lokasi', $request->lokasi);
                        $templateProcessor->setValue('jamAkhirPenawaran', $request->jamAkhirPenawaran);
                        $templateProcessor->setValue('menitAkhirPenawaran', $request->menitAkhirPenawaran);
                        $templateProcessor->setValue('jamAkhirPenawaranWIB', $request->jamAkhirPenawaran - 2);
                        $templateProcessor->setValue('jabatan', auth()->user()->jabatans->namaJabatan);
                        $templateProcessor->setValue('pelelang', Str::of($jafung)->title());
                        $templateProcessor->saveAs('DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx');
                        return response()->download(file: 'DocxTemplate/penetapan Jadwal Lelang - ' . $request->permohonan_lelang_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                        break;

                    default:
                        abort(404);
                        break;
                }
                break;
            case 'salinanRisalah':
                $penetapanLelang = penetapanLelang::find($request->penetapan_lelang_id);

                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/PenyampaianSalinanRL.docx');
                switch ($penetapanLelang->permohonanLelang->jenis) {
                    case 'App\Models\tiket':
                        $templateProcessor->setValue('satker', $penetapanLelang->permohonanLelang->pemohonLelang->pemohon);
                        break;
                    case 'App\Models\suratPersetujuan':
                        $templateProcessor->setValue('satker', $penetapanLelang->permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker);
                        break;
                }
                $templateProcessor->setValue('tanggalLelang', indonesiaDate($penetapanLelang->tanggalLelang));
                $templateProcessor->setValue('suratPenetapan', $penetapanLelang->nomorSurat);
                $templateProcessor->setValue('tanggalPenetapan', indonesiaDate($penetapanLelang->tanggalSurat));
                $templateProcessor->setValue('jumlah',  ucfirst(numberTowords($penetapanLelang->risalah->count())));
                $fancyTableStyle = [
                    'borderSize'  => 4,
                    'borderColor' => '000000',
                    'layout'      => \PhpOffice\PhpWord\Style\Table::LAYOUT_FIXED,
                ];
                $font = [
                    'name' => 'Arial',
                    'size' => 11
                ];
                $table = new Table($fancyTableStyle);
                $table->addRow();
                $table->addCell(580.25983898419, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER,))->addText('No.', $font, array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                $table->addCell(2085.03934686589, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER,))->addText('Nomor Risalah', $font, array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                $table->addCell(2021.25982537789, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER,))->addText('Tanggal Risalah', $font, array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                $table->addCell(3090.86612541187, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER,))->addText('Keterangan', $font, array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                $i = 1;
                foreach (risalah::orderBy('nomor')->get()->where('penetapan_lelang_id', $request->penetapan_lelang_id) as $key) {

                    if ($i === 1) {
                        $vCell = [
                            'vMerge' => 'restart', 'valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER
                        ];
                    } else {
                        $vCell = [
                            'vMerge' => 'continue', 'valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER
                        ];
                    }
                    $table->addRow();
                    $table->addCell(580.25983898419, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER))->addText($i, $font, array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                    $table->addCell(2085.03934686589, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER))->addText($key->nomor, $font);
                    $table->addCell(2021.25982537789, array('valign' => \PhpOffice\PhpWord\SimpleType\VerticalJc::CENTER))->addText(indonesiaDate($key->tanggal), $font, array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                    $table->addCell(3090.86612541187, $vCell)->addText('Disampaikan dengan hormat dan untuk dipergunakan sebagaimana mestinya', $font, array('alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,));
                    $i++;
                }
                $templateProcessor->setComplexBlock('table', $table);

                $templateProcessor->saveAs('DocxTemplate/Penyampaian Salinan RL - ' . $request->penetapan_lelang_id . '.docx');
                return response()->download(file: 'DocxTemplate/Penyampaian Salinan RL - ' . $request->penetapan_lelang_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                break;
            case 'HPKB':
                $permohonanLelang = permohonanLelang::find($request->permohonan_lelang_id);
                switch ($permohonanLelang->jenis) {
                    case 'App\Models\suratPersetujuan':
                        $jafung = Str::ucfirst(auth()->user()->nama);
                        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/HPKB.docx');
                        $templateProcessor->setValue('nomorSurat', $permohonanLelang->nomorSurat);
                        $templateProcessor->setValue('hal', $permohonanLelang->hal);
                        $templateProcessor->setValue('tanggalSurat', indonesiaDate($permohonanLelang->tanggalSurat));
                        $templateProcessor->setValue('tanggalLelang', indonesiaDate($request->tanggalLelang));
                        $templateProcessor->setValue('hariLelang', indonesiaDay($request->tanggalLelang));
                        $templateProcessor->setValue('pemohon', $permohonanLelang->suratPersetujuan->penyampaianLaporan->pemberitahuanPenilaian->permohonanPenilaian->permohonan->satuanKerja->namaSatker);
                        $templateProcessor->setValue('lokasi', $request->lokasi);
                        $templateProcessor->setValue('pelelang', Str::of($jafung)->title());
                        $templateProcessor->setValue('NIPPelelang', auth()->user()->NIP);
                        $templateProcessor->setValue('jabatan', auth()->user()->jabatans->namaJabatan);

                        $templateProcessor->saveAs('DocxTemplate/HPKB - ' . $request->permohonan_lelang_id . '.docx');
                        return response()->download(file: 'DocxTemplate/HPKB - ' . $request->permohonan_lelang_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                        break;

                    case 'App\Models\tiket':
                        $jafung = Str::ucfirst(auth()->user()->nama);
                        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/HPKB.docx');
                        $templateProcessor->setValue('nomorSurat', $permohonanLelang->nomorSurat);
                        $templateProcessor->setValue('hal', $permohonanLelang->hal);
                        $templateProcessor->setValue('tanggalSurat', indonesiaDate($permohonanLelang->tanggalSurat));
                        $templateProcessor->setValue('tanggalLelang', indonesiaDate($request->tanggalLelang));
                        $templateProcessor->setValue('hariLelang', indonesiaDay($request->tanggalLelang));
                        $templateProcessor->setValue('pemohon', $permohonanLelang->pemohonLelang->pemohon);
                        $templateProcessor->setValue('lokasi', $request->lokasi);
                        $templateProcessor->setValue('pelelang', Str::of($jafung)->title());
                        $templateProcessor->setValue('NIPPelelang', auth()->user()->NIP);
                        $templateProcessor->setValue('jabatan', auth()->user()->jabatans->namaJabatan);

                        $templateProcessor->saveAs('DocxTemplate/ND Penyampaian - ' . $request->permohonan_lelang_id . '.docx');
                        return response()->download(file: 'DocxTemplate/ND Penyampaian - ' . $request->permohonan_lelang_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                        break;

                    default:
                        abort(404);
                        break;
                }
                break;
            case 'BASL':
                $BASL = beritaAcaraSurveiLapanganPenilaian::find($request->basl_id);
                switch ($request->jenisObjek) {
                    case 'kendaraan':
                        if ($BASL->user()->count() > 1) {
                            $i = 1;
                            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/BASL Kendaraan - tim.docx');
                            foreach ($BASL->user as $anggotaTim) {
                                $templateProcessor->setValue('nama' . $i, $anggotaTim->nama);
                                $templateProcessor->setValue('NIP' . $i, $anggotaTim->NIP);
                                $i++;
                            }
                        } else {
                            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/BASL Kendaraan.docx');
                            foreach ($BASL->user as $anggotaTim) {
                                $templateProcessor->setValue('nama', $anggotaTim->nama);
                                $templateProcessor->setValue('NIP', $anggotaTim->NIP);
                            }
                        }

                        $templateProcessor->setValue('nomor', $BASL->nomor);
                        $templateProcessor->setValue('kode', $BASL->kode);
                        $templateProcessor->setValue('tahun', $BASL->tahun);
                        $templateProcessor->setValue('pemilik', $BASL->pemilik);
                        $templateProcessor->setValue('tanggal', indonesiaDate($BASL->tanggalSelesaiSurvei));
                        $templateProcessor->setValue('hari', indonesiaDay($BASL->tanggalSelesaiSurvei));
                        $templateProcessor->setValue('tanggalWord', indonesiaDateWords($BASL->tanggalSelesaiSurvei));
                        $templateProcessor->setValue('bulan', indonesiaMonth($BASL->tanggalSelesaiSurvei));
                        $templateProcessor->setValue('tahunSurvei', indonesiaYear($BASL->tanggalSelesaiSurvei));
                        $templateProcessor->setValue('nomorST', $request->nomorSuratTugas);
                        $templateProcessor->setValue('tanggalST', indonesiaDate($request->tanggalSuratTugas));

                        $templateProcessor->saveAs('DocxTemplate/BASL - ' . $request->basl_id . '.docx');
                        return response()->download(file: 'DocxTemplate/BASL - ' . $request->basl_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                        break;

                    case 'nonKendaraan':
                        if ($BASL->user()->count() > 1) {
                            $i = 1;
                            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/BASL Non Kendaraan - tim.docx');
                            foreach ($BASL->user as $anggotaTim) {
                                $templateProcessor->setValue('nama' . $i, $anggotaTim->nama);
                                $templateProcessor->setValue('NIP' . $i, $anggotaTim->NIP);
                                $i++;
                            }
                        } else {
                            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('docxTemplate/BASL Non Kendaraan.docx');
                            foreach ($BASL->user as $anggotaTim) {
                                $templateProcessor->setValue('nama', $anggotaTim->nama);
                                $templateProcessor->setValue('NIP', $anggotaTim->NIP);
                            }
                        }

                        $templateProcessor->setValue('nomor', $BASL->nomor);
                        $templateProcessor->setValue('kode', $BASL->kode);
                        $templateProcessor->setValue('tahun', $BASL->tahun);
                        $templateProcessor->setValue('pemilik', $BASL->pemilik);
                        $templateProcessor->setValue('tanggal', indonesiaDate($BASL->tanggalSelesaiSurvei));
                        $templateProcessor->setValue('hari', indonesiaDay($BASL->tanggalSelesaiSurvei));
                        $templateProcessor->setValue('tanggalWord', indonesiaDateWords($BASL->tanggalSelesaiSurvei));
                        $templateProcessor->setValue('bulan', indonesiaMonth($BASL->tanggalSelesaiSurvei));
                        $templateProcessor->setValue('tahunSurvei', indonesiaYear($BASL->tanggalSelesaiSurvei));
                        $templateProcessor->setValue('nomorST', $request->nomorSuratTugas);
                        $templateProcessor->setValue('tanggalST', indonesiaDate($request->tanggalSuratTugas));

                        $templateProcessor->saveAs('DocxTemplate/BASL - ' . $request->basl_id . '.docx');
                        return response()->download(file: 'DocxTemplate/BASL - ' . $request->basl_id . '.docx')->deleteFileAfterSend(shouldDelete: true);
                        break;

                        break;

                    default:

                        break;
                }


                break;
            default:
                abort(404);
                break;
        }
    }
}
