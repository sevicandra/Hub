<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\agendaLaporanPenilaian;
use Illuminate\Support\Facades\Storage;
use App\Models\beritaAcaraSurveiLapanganPenilaian;
use Illuminate\Support\Facades\Redirect;

class AgendaLaporanPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' ) {
            return view('JFPP.laporanPenilaian',[
                'data'=>agendaLaporanPenilaian::paginate(20)->withQueryString(),
                'basl'=>beritaAcaraSurveiLapanganPenilaian::doesntHave('laporan')->get(),
                'laporan'=>'',
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
               'nomor'=>'required',
               'tanggal' =>'required',
               'kode'=>'required',
               'pemohon'=>'required',
               'nilaiWajar'=>'required',
               'basl'=>'required'
            ]);
    
            if ($request->fileUpload) {
                $request->validate([
                    'fileUpload'=>'required|mimes:pdf'
                ]);
    
                $path = $request->file('fileUpload')->store('laporanPenilaian');
                
                $agendaLaporanPenilaian=agendaLaporanPenilaian::create([
                    'nomor'=> $request['nomor'],
                    'tanggal' => $request['tanggal'],
                    'kode'=> $request['kode'],
                    'pemohon'=> $request['pemohon'],
                    'nilaiWajar'=> $request['nilaiWajar'],
                    'file'=> $path,
                    'tahun'=>$date->year
                ]);
            }else{
                $agendaLaporanPenilaian=agendaLaporanPenilaian::create([
                    'nomor'=> $request['nomor'],
                    'tanggal' => $request['tanggal'],
                    'kode'=> $request['kode'],
                    'pemohon'=> $request['pemohon'],
                    'nilaiWajar'=> $request['nilaiWajar'],
                    'tahun'=>$date->year
                ]);
            }
    
            foreach ($request->basl as $key) {
                $agendaLaporanPenilaian->basl()->attach($key);
            }
        }else{
            abort(403);
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\agendaLaporanPenilaian  $agendaLaporanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function show(agendaLaporanPenilaian $agendaLaporanPenilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\agendaLaporanPenilaian  $agendaLaporanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(agendaLaporanPenilaian $LaporanPenilaian)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' ) {
            $LaporanPenilaian->basl;
            return json_encode($LaporanPenilaian);
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\agendaLaporanPenilaian  $agendaLaporanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, agendaLaporanPenilaian $LaporanPenilaian)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' ) {
            if ($request->fileUpload) {
                $request->validate([
                    'nomor'=>'required',
                    'tanggal' =>'required',
                    'kode'=>'required',
                    'pemohon'=>'required',
                    'nilaiWajar'=>'required',
                    'fileUpload'=>'required|mimes:pdf'
                ]);
                if ($LaporanPenilaian->file) {
                    Storage::delete($LaporanPenilaian->file);
                }
                $path = $request->file('fileUpload')->store('laporanPenilaian');
                $LaporanPenilaian->update([
                    'nomor'=> $request['nomor'],
                    'tanggal' => $request['tanggal'],
                    'kode'=> $request['kode'],
                    'pemohon'=> $request['pemohon'],
                    'nilaiWajar'=> $request['nilaiWajar'],
                    'file'=>$path
                ]);
            }else{
                $request->validate([
                    'nomor'=>'required',
                    'tanggal' =>'required',
                    'kode'=>'required',
                    'pemohon'=>'required',
                    'nilaiWajar'=>'required',
                ]);
        
                $LaporanPenilaian->update([
                    'nomor'=> $request['nomor'],
                    'tanggal' => $request['tanggal'],
                    'kode'=> $request['kode'],
                    'pemohon'=> $request['pemohon'],
                    'nilaiWajar'=> $request['nilaiWajar']
                ]);
            }
    
            if ($request->basl) {
                foreach ($request->basl as $key) {
                    $LaporanPenilaian->basl()->attach($key);
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
     * @param  \App\Models\agendaLaporanPenilaian  $agendaLaporanPenilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(agendaLaporanPenilaian $LaporanPenilaian)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' ) {
            $LaporanPenilaian->basl()->detach();
            $LaporanPenilaian->delete();
        }else{
            abort(403);
        }
        return Redirect::back();
    }
}
