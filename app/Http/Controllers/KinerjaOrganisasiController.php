<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kinerjaOrganisasi;
use App\Http\Requests\StorekinerjaOrganisasiRequest;
use App\Http\Requests\UpdatekinerjaOrganisasiRequest;

class KinerjaOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('praktisKinerjaOrganisasi',[
            'data' => kinerjaOrganisasi::all()
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
        $ValidatedData=$request->validate(
            [
                'KodeIKU'=>'required',
                'namaIKU'=>'required',
                'konsolidasi'=>'required',
                'polarisasi'=>'required'
            ]);
        $ValidatedData['tahun'] = $request->session()->get('tahun');
        kinerjaOrganisasi::create($ValidatedData);
        return redirect($request->session()->get('_previous')['url']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kinerjaOrganisasi  $kinerjaOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function show(kinerjaOrganisasi $kinerjaorganisasi)
    {
        return view('praktisCapaian',[
            'data' => $kinerjaorganisasi,
            'jenisKinerja'=>'App\Models\kinerjaOrganisasi',
            'back'=>'kinerjaorganisasi'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kinerjaOrganisasi  $kinerjaOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function edit(kinerjaOrganisasi $kinerjaOrganisasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekinerjaOrganisasiRequest  $request
     * @param  \App\Models\kinerjaOrganisasi  $kinerjaOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekinerjaOrganisasiRequest $request, kinerjaOrganisasi $kinerjaOrganisasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kinerjaOrganisasi  $kinerjaOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(kinerjaOrganisasi $kinerjaOrganisasi)
    {
        //
    }
}
