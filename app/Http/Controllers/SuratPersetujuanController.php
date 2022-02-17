<?php

namespace App\Http\Controllers;

use App\Models\tiket;
use Illuminate\Http\Request;
use App\Models\suratPersetujuan;
use App\Models\penyampaianLaporan;
use App\Http\Requests\StoresuratPersetujuanRequest;
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
        $tiket_id = penyampaianLaporan::all()->find($request->penyampaian_laporan_id)->pemberitahuanPenilaian->permohonanPenilaian->permohonan->tiket->id;
        $key = penyampaianLaporan::all()->find($request->penyampaian_laporan_id)->suratPersetujuan;
        if (!isset($key)) {
            $ValidatedData=$request->validate([
                'nomorSurat'=>'required',
                'tanggalSurat'=>'required',
                'penyampaian_laporan_id'=>'required',
            ]);
            suratPersetujuan::create($ValidatedData);
            tiket::find($tiket_id)->update([
                'persetujuan' =>0,
                'lelang' => 0,
            ]);



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
    public function show(suratPersetujuan $suratPersetujuan)
    {
        //
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
