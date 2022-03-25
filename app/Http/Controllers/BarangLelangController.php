<?php

namespace App\Http\Controllers;

use App\Models\barangLelang;
use Illuminate\Http\Request;
use App\Http\Requests\StorebarangLelangRequest;
use App\Http\Requests\UpdatebarangLelangRequest;
use App\Models\risalah;
use Illuminate\Support\Facades\Redirect;

class BarangLelangController extends Controller
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
        $i=0;
        $len = count ($request->barang);
        while ($i < $len) {
            if (!risalah::find($request->risalah_id)->penetapanLelang->barangLelang->where('barang_id', $request->barang[$i])->first()) {
                barangLelang::create([
                    'risalah_id'=>$request->risalah_id,
                    'barang_id'=>$request->barang[$i],
                    'status'=>$request->status[$i],
                ]);
            }
            $i++;
        }
        return redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barangLelang  $barangLelang
     * @return \Illuminate\Http\Response
     */
    public function show(barangLelang $barangLelang)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barangLelang  $barangLelang
     * @return \Illuminate\Http\Response
     */
    public function edit(barangLelang $barangLelang)
    {
        if ($barangLelang->risalah->penetapanLelang->status != 1) {
            $barangLelang->delete();
            return redirect::back();
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebarangLelangRequest  $request
     * @param  \App\Models\barangLelang  $barangLelang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebarangLelangRequest $request, barangLelang $barangLelang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barangLelang  $barangLelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barangLelang $barangLelang)
    {
        //
    }
}
