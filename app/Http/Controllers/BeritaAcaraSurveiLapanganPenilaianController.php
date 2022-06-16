<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\beritaAcaraSurveiLapanganPenilaian;


class BeritaAcaraSurveiLapanganPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' ) {
            return view('JFPP.BASL',[
                'data'=>beritaAcaraSurveiLapanganPenilaian::paginate(20)->withQueryString(),
                'tim'=>User::where('email_verified_at', '!=', null)->orderBy('NIP', 'asc')->get(),
                'BASL'=>'',
                'favicon'=>'/img/ico/JFPP.png',
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
        $date = new Carbon( $request->tanggal );
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' ) {
            $request->validate([
                'nomor'=>'required|numeric',
                'kode'=>'required',
                'tujuanPenilaian'=>'required',
                'objek'=>'required',
                'pemilik'=>'required',
                'tanggalMulaiSurvei'=>'required',
                'tanggalSelesaiSurvei'=>'required',
                'anggotaTim'=>'required',
            ]);
            $basl=beritaAcaraSurveiLapanganPenilaian::create([
                'nomor'=>$request['nomor'],
                'kode'=>$request['kode'],
                'tujuanPenilaian'=>$request['tujuanPenilaian'],
                'objek'=>$request['objek'],
                'pemilik'=>$request['pemilik'],
                'tanggalMulaiSurvei'=>$request['tanggalMulaiSurvei'],
                'tanggalSelesaiSurvei'=>$request['tanggalSelesaiSurvei'],
                'tahun'=>$date->year
            ]);
            foreach ($request->anggotaTim as $key) {
                $basl->user()->attach($key);
            }
        }else{
            abort(403);
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\beritaAcaraSurveiLapanganPenilaian  $beritaAcaraSurveiLapanganPenilaian
     * @return \Illuminate\Http\Response
     */
    public function show(beritaAcaraSurveiLapanganPenilaian $beritaAcaraSurveiLapanganPenilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\beritaAcaraSurveiLapanganPenilaian  $beritaAcaraSurveiLapanganPenilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(beritaAcaraSurveiLapanganPenilaian $BASL)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' ) {
            $BASL->user;
            return json_encode($BASL);
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\beritaAcaraSurveiLapanganPenilaian  $beritaAcaraSurveiLapanganPenilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, beritaAcaraSurveiLapanganPenilaian $BASL)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' ) {
            if ($BASL->laporan) {
                abort(403);
            }else{
                $request->validate([
                    'nomor'=>'required|numeric',
                    'kode'=>'required',
                    'tujuanPenilaian'=>'required',
                    'objek'=>'required',
                    'pemilik'=>'required',
                    'tanggalMulaiSurvei'=>'required',
                    'tanggalSelesaiSurvei'=>'required',
                    'anggotaTim'=>'required',
                ]);
                $BASL->update([
                    'nomor'=>$request['nomor'],
                    'kode'=>$request['kode'],
                    'tujuanPenilaian'=>$request['tujuanPenilaian'],
                    'objek'=>$request['objek'],
                    'pemilik'=>$request['pemilik'],
                    'tanggalMulaiSurvei'=>$request['tanggalMulaiSurvei'],
                    'tanggalSelesaiSurvei'=>$request['tanggalSelesaiSurvei'],
                ]);
                foreach ($request->anggotaTim as $key) {
                    $BASL->user()->attach($key);
                }
            }
        }else{
            abort(403);
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\beritaAcaraSurveiLapanganPenilaian  $beritaAcaraSurveiLapanganPenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(beritaAcaraSurveiLapanganPenilaian $BASL)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' ) {
            if ($BASL->laporan->first()) {
                abort(403);
            }else{
                $BASL->user()->detach();
                $BASL->delete();
            }
        }else{
            abort(403);
        }
    }
}
