<?php

namespace App\Http\Controllers;

use App\Models\risalah;
use App\Models\lotLelang;
use Illuminate\Http\Request;
use App\Models\risalahLotLelang;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorerisalahLotLelangRequest;
use App\Http\Requests\UpdaterisalahLotLelangRequest;

class RisalahLotLelangController extends Controller
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
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11') {
            $i=0;
            $len = count ($request->barang);
            while ($i < $len) {
                if (!risalah::find($request->risalah_id)->risalahLotLelang->where('lot_lelang_id', $request->barang[$i])->first()) {
                    risalahLotLelang::create([
                        'risalah_id'=>$request->risalah_id,
                        'lot_lelang_id'=>$request->barang[$i],
                        'status'=>$request->status[$i],
                    ]);
                    lotLelang::find($request->barang[$i])->update(['status' => 1]);
                }
                $i++;
            }
            return Redirect::back();
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\risalahLotLelang  $risalahLotLelang
     * @return \Illuminate\Http\Response
     */
    public function show(risalahLotLelang $risalahLotLelang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\risalahLotLelang  $risalahLotLelang
     * @return \Illuminate\Http\Response
     */
    public function edit(risalahLotLelang $lot_lelang)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '07' || auth()->user()->jabatan === '08' || auth()->user()->jabatan === '11') {
            if ($lot_lelang->risalah->penetapanLelang->status != 1) {
                $lot_lelang->lotLelang->update(['status'=>0]);
                $lot_lelang->delete();
                return redirect::back();
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdaterisalahLotLelangRequest  $request
     * @param  \App\Models\risalahLotLelang  $risalahLotLelang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdaterisalahLotLelangRequest $request, risalahLotLelang $risalahLotLelang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\risalahLotLelang  $risalahLotLelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(risalahLotLelang $risalahLotLelang)
    {

    }
}
