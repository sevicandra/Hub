<?php

namespace App\Http\Controllers;

use App\Models\permohonan;
use App\Models\tiket;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pindaiPermohonan',[
            'data'=>permohonan::all(),
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
        //
        $tiket_id=tiket::count();
        $tiket_id++;
        $tiket='PKN';
        if ($tiket_id < 10) {
            $tiket .= '0000';
        }elseif ($tiket_id < 100) {
            $tiket .= '000';
        }elseif ($tiket_id < 1000) {
            $tiket .= '000';
        }elseif ($tiket_id < 10000) {
            $tiket .= '00';
        }elseif ($tiket_id < 100000) {
            $tiket .= '0';
        }elseif ($tiket_id >= 100000) {
            $tiket .= '';
        }
        $tiket .= $tiket_id; 
        $tikets['tiket'] = $tiket;
        $tikets['permohonan'] = 1;
        tiket::create($tikets);

        $id_tiket=tiket::latest()->first()->id;

        $ValidatedData=$request->validate(
            [
                'nomorSurat'=>'required',
                'tanggalSurat'=>'required',
                'pemohon'=>'required',
                'tanggalDiTerima'=>'required'
            ]);
            
            $ValidatedData['tiket_id']=$id_tiket;
            permohonan::create($ValidatedData);
            return redirect('/pindaipermohonan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function show(permohonan $permohonan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function edit(permohonan $permohonan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, permohonan $permohonan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function destroy(permohonan $permohonan)
    {
        //
    }
}
