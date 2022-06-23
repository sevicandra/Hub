<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kepuasanPelanggan;
use App\Http\Requests\StorekepuasanPelangganRequest;
use App\Http\Requests\UpdatekepuasanPelangganRequest;
use Illuminate\Support\Facades\Redirect;

class KepuasanPelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('survey',[
            'title'=>'TERNATE-HUB || Survei Kepuasan Pengguna Layanan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('survei.index',[
            'data'=>kepuasanPelanggan::orderBy('created_at', 'desc')->Filter()->paginate(20)->withQueryString(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'layanan'=>'required',
            'tangibles'=>'required',
            'reliability'=>'required',
            'responsiveness'=>'required',
            'assurance'=>'required',
            'empathy'=>'required',
        ]);
        kepuasanPelanggan::create($validatedData);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kepuasanPelanggan  $kepuasanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(kepuasanPelanggan $kepuasanPelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kepuasanPelanggan  $kepuasanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(kepuasanPelanggan $kepuasanPelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekepuasanPelangganRequest  $request
     * @param  \App\Models\kepuasanPelanggan  $kepuasanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekepuasanPelangganRequest $request, kepuasanPelanggan $kepuasanPelanggan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kepuasanPelanggan  $kepuasanPelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(kepuasanPelanggan $kepuasanPelanggan)
    {
        //
    }
}
