<?php

namespace App\Http\Controllers;

use App\Models\permohonanPenilaian;
use Illuminate\Http\Request;
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
        $key= permohonanPenilaian::all()->find($request->permohonan_penilaian_id)->pemberitahuanPenilaian;
        if (!isset($key)) {
            $ValidatedData=$request->validate(
                [
                    'nomorSurat'=>'required',
                    'tanggalSurat'=>'required',
                    'permohonan_penilaian_id'=>'required'
                ]);
                pemberitahuanPenilaian::create($ValidatedData);
                return redirect('/penilaian');
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
