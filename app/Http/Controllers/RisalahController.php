<?php

namespace App\Http\Controllers;

use App\Models\risalah;
use Illuminate\Http\Request;
use App\Models\penetapanLelang;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorerisalahRequest;
use App\Http\Requests\UpdaterisalahRequest;

class RisalahController extends Controller
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
        if (penetapanLelang::find($request->penetapan_lelang_id)->status != 1) {
            $validatedData=$request->validate([
                'nomor'=>'required',
                'tanggal'=>'required',
                'nilaiPokok'=>'required|numeric',
                'penetapan_lelang_id'=>'required'
            ]);
            risalah::create($validatedData);
            return redirect::back();    
        }else{
            abort(403);
        }       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\risalah  $risalah
     * @return \Illuminate\Http\Response
     */
    public function show(risalah $risalah)
    {
        $barang = $risalah->barang;
        $status = $risalah->barangLelang;

        return json_encode(['barang'=>$barang, 'status'=>$status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\risalah  $risalah
     * @return \Illuminate\Http\Response
     */
    public function edit(risalah $risalah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdaterisalahRequest  $request
     * @param  \App\Models\risalah  $risalah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdaterisalahRequest $request, risalah $risalah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\risalah  $risalah
     * @return \Illuminate\Http\Response
     */
    public function destroy(risalah $risalah)
    {
        if (!$risalah->barangLelang->first()) {
            $risalah->delete();
            return Redirect::back();
        }else{
            abort(403);
        }
    }
}
