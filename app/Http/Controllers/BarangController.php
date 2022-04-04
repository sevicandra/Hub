<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\permohonan;
use Illuminate\Http\Request;

class BarangController extends Controller
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
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12') {
            $key= permohonan::all()->find($request->permohonan_id)->tiket->permohonan;
            if ($key === 1) {
                $ValidatedData=$request->validate(
                    [
                        'kodeBarang'=>'required',
                        'NUP'=>'required',
                        'merkType'=>'required',
                        'tahunPerolehan'=>'required',
                        'nilaiPerolehan'=>'required',
                        'permohonan_id'=>'required',
                        'nomorRangka'=>'',
                        'nomorPolisi'=>'',
                        'nomorMesin'=>'',
                        'keterangan'=>''
                    ]);
                barang::create($ValidatedData);
                $redirect = '/permohonan/';
                $redirect .= $ValidatedData['permohonan_id'];
                return redirect($redirect);
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
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        
        return view('pindai.Barang',[
            'title'=> 'TERNATE-HUB || PINDAI',
            'favicon'=>'/img/ico/pindai.png'
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(barang $barang)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' || auth()->user()->jabatan === '11') {
            $laporan = $barang->laporanPenilaian->id;
            $permohonan = $barang->laporanPenilaian->pemberitahuanPenilaian->permohonanPenilaian->id;
            barang::find($barang->id)->update([
                'laporan_penilaian_id'=>null,
                'nilaiWajar'=>''
            ]);
            return redirect('/penilaian/'. $permohonan)->with(['loadData' => $laporan]);
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebarangRequest  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $barang)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12') {
            if ($barang->permohonan->tiket->permohonan === 1) {
                $barang->delete();
                return redirect('/permohonan/'. $barang->permohonan->id);
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }
    }
}
