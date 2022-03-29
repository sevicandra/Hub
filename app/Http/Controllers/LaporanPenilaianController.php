<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laporanPenilaian;
use App\Models\pemberitahuanPenilaian;

class LaporanPenilaianController extends Controller
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
        $key=pemberitahuanPenilaian::all()->find($request->pemberitahuan_penilaian_id);
        if (!isset($key->penyampaianLaporan)) {
            $ValidatedData=$request->validate([
                'nomorLaporan'=>'required',
                'tanggalLaporan'=>'required',
                'pemberitahuan_penilaian_id'=>'required',
            ]);
            laporanPenilaian::create($ValidatedData);
            return redirect('/penilaian/'. $key->permohonan_penilaian_id);
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\laporanPenilaian  $laporanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function show(laporanPenilaian $laporanpenilaian)
    {
        //

        return json_encode($laporanpenilaian->barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\laporanPenilaian  $laporanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(laporanPenilaian $laporanPenilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\laporanPenilaian  $laporanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, laporanPenilaian $laporanPenilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\laporanPenilaian  $laporanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(laporanPenilaian $laporanpenilaian)
    {
        $key = $laporanpenilaian->pemberitahuanPenilaian->penyampaianLaporan;
        $key2 = $laporanpenilaian->barang->first();
        if(!isset($key2)){
            if (!isset($key)) {
                $laporanpenilaian->delete();
                return redirect('/penilaian/'. $laporanpenilaian->pemberitahuanPenilaian->permohonan_penilaian_id);
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }
    }
}
