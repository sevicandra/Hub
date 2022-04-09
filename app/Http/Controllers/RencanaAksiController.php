<?php

namespace App\Http\Controllers;

use App\Models\rencanaAksi;
use Illuminate\Http\Request;
use App\Models\idikatorKinerjaUtama;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorerencanaAksiRequest;
use App\Http\Requests\UpdaterencanaAksiRequest;

class RencanaAksiController extends Controller
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
            'rencanaAksi'=>'required',
            'tanggalMulai'=>'required||date',
            'tanggalSelesai'=>'required||date',
            'idikator_kinerja_utama_id'=>'required',
        ]);
        rencanaAksi::create($validatedData);
        return Redirect::back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function show(idikatorKinerjaUtama $rencana_aksi)
    {
        if ($rencana_aksi->user_id === auth()->user()->id || auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15') {
            return view('praktis.RancanaAksi',[
                'back'=> '/praktis',
                'data'=>$rencana_aksi,
                'title'=> 'TERNATE-HUB || PRAKTIS',
                'favicon'=>'/img/ico/praktis.png'
            ]);
        }
    }

    public function monitoringRencanaAksi(idikatorKinerjaUtama $rencana_aksi)
    {
        if ($rencana_aksi->user_id === auth()->user()->id || auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15') {
            return view('praktis.RancanaAksi',[
                'back'=> '/monitoring/'.$rencana_aksi->user_id,
                'data'=>$rencana_aksi,
                'title'=> 'TERNATE-HUB || PRAKTIS',
                'favicon'=>'/img/ico/praktis.png'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function edit(rencanaAksi $rencanaAksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\rencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rencanaAksi $rencana_aksi)
    {
        if ($rencana_aksi->idikatorKinerjaUtama->user_id === auth()->user()->id) {
            switch ($request->button) {
                case 'Done':
                    $rencana_aksi->update(['status'=> '1']);
                    break;
                case 'Undone':
                    $rencana_aksi->update(['status'=> '0']);
                    break;
                
                default:
                    abort(404);
                    break;
            }
            return Redirect::back();
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rencanaAksi  $rencanaAksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(rencanaAksi $rencanaAksi)
    {
        //
    }
}
