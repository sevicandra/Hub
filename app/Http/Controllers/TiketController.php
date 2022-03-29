<?php

namespace App\Http\Controllers;

use App\Models\tiket;
use App\Http\Requests\StoretiketRequest;
use App\Http\Requests\UpdatetiketRequest;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pindai.Home',[
            'permohonan'=>tiket::all()->where('permohonan', '=' , '1'),
            'penilaian'=>tiket::all()->where('penilaian', '=' , '1'),
            'persetujuan'=>tiket::all()->where('persetujuan', '=' , '1'),
            'lelang'=>tiket::all()->where('lelang', '=' , '1'),
            'selesaiLelang'=>tiket::all()->where('permohonan', '=' , '0')->where('penilaian', '=' , '0')->where('persetujuan', '=' , '0')->where('lelang', '=' , '0'),
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
     * @param  \App\Http\Requests\StoretiketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretiketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function show(tiket $tiket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function edit(tiket $tiket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetiketRequest  $request
     * @param  \App\Models\tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetiketRequest $request, tiket $tiket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tiket  $tiket
     * @return \Illuminate\Http\Response
     */
    public function destroy(tiket $tiket)
    {
        //
    }
}
