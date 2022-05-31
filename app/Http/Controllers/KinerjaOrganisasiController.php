<?php

namespace App\Http\Controllers;

use App\Models\capaian;
use Illuminate\Http\Request;
use App\Models\kinerjaOrganisasi;
use Illuminate\Support\Facades\Redirect;
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
        if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15') {
            return view('praktis.KinerjaOrganisasi',[
                'data' => kinerjaOrganisasi::orderBy('kodeIKU')->where('tahun', session()->get('tahun'))->get(),
                'title'=> 'TERNATE-HUB || PRAKTIS',
                'back'=>'/home',
                'favicon'=>'/img/ico/praktis.png',
                'kinerjaOrganisasi'=>''
            ]);
        }else{
            abort(403);
        }
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
        if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15') {
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
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kinerjaOrganisasi  $kinerjaOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function show(kinerjaOrganisasi $kinerjaorganisasi)
    {
        if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15') {
            return view('praktis.Capaian',[
                'data' => $kinerjaorganisasi,
                'capaian'=>capaian::where('idikator_kinerja_utama_id', $kinerjaorganisasi->id)->orderby('bulan', 'asc')->get(),
                'jenisKinerja'=>'App\Models\kinerjaOrganisasi',
                'back'=>url()->previous(),
                'title'=> 'TERNATE-HUB || PINDAI',
                'favicon'=>'/img/ico/praktis.png'
            ]);
        }else{
            abort(403);
        }
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
    public function destroy(kinerjaOrganisasi $kinerjaorganisasi)
    {
        
        if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15') {
            $kinerjaorganisasi->delete();
            return redirect::back();
            
        }else{
            abort(403);
        }
    }
}
