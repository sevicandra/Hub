<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tiket;
use Illuminate\Http\Request;
use App\Models\penyampaianLaporan;
use App\Models\pemberitahuanPenilaian;
use App\Http\Requests\StorepenyampaianLaporanRequest;
use App\Http\Requests\UpdatepenyampaianLaporanRequest;

class PenyampaianLaporanController extends Controller
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
            $key = pemberitahuanPenilaian::find($request->pemberitahuan_penilaian_id)->penyampaianLaporan;
            if (!isset($key)) {
                $ValidatedData=$request->validate(
                    [
                        'nomorSurat'=>'required',
                        'tanggalSurat'=>'required',
                        'pemberitahuan_penilaian_id'=>'required'
                    ]);
                $tiket_id = pemberitahuanPenilaian::find($request->pemberitahuan_penilaian_id)->permohonanPenilaian->permohonan->tiket;
                $tiket=tiket::find($tiket_id->id);
                $tiket->update(['persetujuan'=>1,'penilaian'=>0]);
                penyampaianLaporan::create($ValidatedData);
                $to=User::where('jabatan', '03')->orwhere('jabatan', '12')->get();
                notifikasiPermohonanInternal($to, auth()->user()->nama, "Laporan Penilaian BMN pada Satuan Kerja ".$tiket->permohonans->satuanKerja->namaSatker." telah dikirim melalui KPKNL TERNATE-HUB",config('whatsapp.key'),config('whatsapp.phoneNumber'));
                return redirect('/penilaian');
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
     * @param  \App\Models\penyampaianLaporan  $penyampaianLaporan
     * @return \Illuminate\Http\Response
     */
    public function show(penyampaianLaporan $penyampaianLaporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penyampaianLaporan  $penyampaianLaporan
     * @return \Illuminate\Http\Response
     */
    public function edit(penyampaianLaporan $penyampaianLaporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepenyampaianLaporanRequest  $request
     * @param  \App\Models\penyampaianLaporan  $penyampaianLaporan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepenyampaianLaporanRequest $request, penyampaianLaporan $penyampaianLaporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penyampaianLaporan  $penyampaianLaporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(penyampaianLaporan $penyampaianLaporan)
    {
        //
    }
}
