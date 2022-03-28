<?php

namespace App\Http\Controllers;

use App\Models\kementerian;
use App\Models\satuanKerja;
use Illuminate\Support\Facades\Redirect;
use App\Models\profilSatker;
use Illuminate\Http\Request;

class satker extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('satker',[
            'data'=>satuanKerja::orderBy('kodeSatkerFull')->paginate(15),
            'kementerian'=>kementerian::orderBy('id')->get()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\satuanKerja  $satuanKerja
     * @return \Illuminate\Http\Response
     */
    public function show(satuanKerja $satker)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\satuanKerja  $satuanKerja
     * @return \Illuminate\Http\Response
     */
    public function edit(satuanKerja $satker)
    {
        return json_encode([
            'satker' => $satker,
            'kementerian' => $satker->kementerian,
            'profil' => $satker->profil
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\satuanKerja  $satuanKerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, satuanKerja $satker)
    {
        $validatedData=$request->validate([
            "kementerian_id"=>'required',
            "namaSatker"=>'required',
            "alamat"=>'required',
            "namaKepalaSatker"=>'required',
            "noTeleponKepalaSatker"=>'required',
            "namaOperatorSatker"=>'required',
            "noTeleponOperatorSatker"=>'required'
        ]);
            $satker->update([
                "kementerian_id"=>$validatedData['kementerian_id'],
                "namaSatker"=>$validatedData['namaSatker'],    
            ]);
            if ($satker->profil === null) { 
                profilSatker::create([
                    'satuan_kerja_id'=>$satker->id,
                    'alamat'=>$validatedData['alamat'],
                    'namaKepalaSatker'=>$validatedData['namaKepalaSatker'],
                    'noTeleponKepalaSatker'=>$validatedData['noTeleponKepalaSatker'],
                    'namaOperator'=>$validatedData['namaOperatorSatker'],
                    'noTeleponOperator'=>$validatedData['noTeleponOperatorSatker'],
                ]);
            }else {
                $satker->profil->update([
                    'satuan_kerja_id'=>$satker->id,
                    'alamat'=>$validatedData['alamat'],
                    'namaKepalaSatker'=>$validatedData['namaKepalaSatker'],
                    'noTeleponKepalaSatker'=>$validatedData['noTeleponKepalaSatker'],
                    'namaOperator'=>$validatedData['namaOperatorSatker'],
                    'noTeleponOperator'=>$validatedData['noTeleponOperatorSatker'],
                ]);
            }
            return redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\satuanKerja  $satuanKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(satuanKerja $satuanKerja)
    {
        //
    }
}
