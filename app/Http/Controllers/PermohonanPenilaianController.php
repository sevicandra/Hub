<?php

namespace App\Http\Controllers;

use App\Models\tiket;
use App\Models\permohonan;
use Illuminate\Http\Request;
use App\Models\permohonanPenilaian;

class PermohonanPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pindaiPenilaian',[
            'data'=>permohonanPenilaian::orderBy('created_at', 'desc')->get(),
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
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $key= permohonan::all()->find($request->permohonan_id)->tiket->permohonan;
        if ($key === 1) {
            $ValidatedData=$request->validate(
                [
                    'nomorSurat'=>'required',
                    'tanggalSurat'=>'required',
                    'permohonan_id'=>'required'
                ]);
            permohonanPenilaian::create($ValidatedData);
            $data = permohonan::all()->find($request->permohonan_id)->tiket_id;
            tiket::where('id', $data)->update(['permohonan'=>0,'penilaian'=>1]);
            return redirect('/permohonan');     
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permohonanPenilaian  $permohonanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function show(permohonanPenilaian $permohonanPenilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permohonanPenilaian  $permohonanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(permohonanPenilaian $permohonanPenilaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\permohonanPenilaian  $permohonanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permohonanPenilaian $permohonanPenilaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permohonanPenilaian  $permohonanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(permohonanPenilaian $permohonanPenilaian)
    {
        //
    }
}
