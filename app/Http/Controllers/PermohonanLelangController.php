<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\permohonanLelang;
use App\Http\Requests\UpdatepermohonanLelangRequest;
use Illuminate\Support\Facades\Redirect;

class PermohonanLelangController extends Controller
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
        $validatedData=$request->validate([
            'nomorSurat'=>'required',
            'tanggalSurat'=>'required',
            'tanggalDiTerima'=>'required',
            'surat_persetujuan_id'=>'required',
        ]);
        permohonanLelang::create($validatedData);
        return redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permohonanLelang  $permohonanLelang
     * @return \Illuminate\Http\Response
     */
    public function show(permohonanLelang $permohonanLelang)
    {
        return json_encode($permohonanLelang->barang) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permohonanLelang  $permohonanLelang
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, permohonanLelang $permohonanLelang)
    {
        if (!$permohonanLelang->penetapanLelang) {
            $permohonanLelang->barang->find($request->barang_id)->update(['status'=> 0]);
            $permohonanLelang->barang()->detach($request->barang_id);
            return redirect::back();
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\permohonanLelang  $permohonanLelang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permohonanLelang $permohonanLelang)
    {
        if (!$permohonanLelang->penetapanLelang) {
            foreach($request->barang as $barang){
                $c=$permohonanLelang->barang->find($barang);
                if (!isset($c)) {
                    $permohonanLelang->barang()->attach($barang);
                    permohonanLelang::find($permohonanLelang->id)->barang->find($barang)->update(['status'=> 1]);
                }
            }
            return redirect::back();
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permohonanLelang  $permohonanLelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(permohonanLelang $permohonanLelang)
    {
        if (!$permohonanLelang->penetapanLelang) {
            $permohonanLelang->delete();
            return redirect::back();
        }else{
            abort(403);
        } 
    }
}