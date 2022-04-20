<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\laporanPelaksanaanTugas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorelaporanPelaksanaanTugasRequest;
use App\Http\Requests\UpdatelaporanPelaksanaanTugasRequest;

class LaporanPelaksanaanTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=laporanPelaksanaanTugas::orderby('tanggal', 'desc')->orderby('nomor', 'desc');
        return view('digitalKnowledgeManagement.laporan-pelaksanaan-tugas',[
            'data'=>$data->Search()->paginate(20)->withQueryString(),
            'search'=>'',
            'title'=> 'TERNATE-HUB || FILE STORAGE',
            'favicon'=>'/img/ico/Digital Knoledge Management.png',
            'laporanpelaksanaantugas'=>''
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
        $request->validate([
            'nomor'=>'required',
            'kodeUnit'=>'required',
            'tanggal'=>'required',
            'hal'=>'required',
            'fileUpload'=>'required|mimes:pdf'
        ]);

        $path = $request->file('fileUpload')->store('laporan-pelaksanaan-tugas');
        
        laporanPelaksanaanTugas::create([
            'nomor'=>$request->nomor,
            'kodeUnit'=>'LPT-'.$request->nomor. $request->kodeUnit. date('Y', strtotime($request->tanggal)),
            'tanggal'=>$request->tanggal,
            'hal'=>$request->hal,
            'file'=>$path,
            'user_id'=>auth()->user()->id
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\laporanPelaksanaanTugas  $laporanPelaksanaanTugas
     * @return \Illuminate\Http\Response
     */
    public function show(laporanPelaksanaanTugas $laporan_pelaksanaan_tuga)
    {
        if ($laporan_pelaksanaan_tuga->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
            return json_encode($laporan_pelaksanaan_tuga);
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\laporanPelaksanaanTugas  $laporanPelaksanaanTugas
     * @return \Illuminate\Http\Response
     */
    public function edit(laporanPelaksanaanTugas $laporan_pelaksanaan_tuga)
    {
        if ($laporan_pelaksanaan_tuga->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
            return json_encode($laporan_pelaksanaan_tuga);
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\laporanPelaksanaanTugas  $laporanPelaksanaanTugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, laporanPelaksanaanTugas $laporan_pelaksanaan_tuga)
    {
        if ($laporan_pelaksanaan_tuga->created_at->diff(Carbon::now())->days > 0) {
            if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                $request->validate([
                    'nomor'=>'required',
                    'kodeUnit'=>'required',
                    'tanggal'=>'required',
                    'hal'=>'required',
                ]);
                if ($request->fileUpload) {
                    $request->validate([
                        'fileUpload'=>'required|mimes:pdf'
                    ]);
                    Storage::delete($laporan_pelaksanaan_tuga->file);
                    $path = $request->file('fileUpload')->store('laporan-pelaksanaan-tugas');
                }
        
                if (isset($path)) {
                    $laporan_pelaksanaan_tuga->update([
                        'nomor'=>$request->nomor,
                        'kodeUnit'=>'KEP-'.$request->nomor. $request->kodeUnit. date('Y', strtotime($request->tanggal)),
                        'tanggal'=>$request->tanggal,
                        'hal'=>$request->hal,
                        'file'=>$path,
                    ]);
                }else{
                    $laporan_pelaksanaan_tuga->update([
                        'nomor'=>$request->nomor,
                        'kodeUnit'=>'KEP-'.$request->nomor. $request->kodeUnit. date('Y', strtotime($request->tanggal)),
                        'tanggal'=>$request->tanggal,
                        'hal'=>$request->hal,
                    ]);
                }
                return  Redirect::back();
            }else{
                abort(403);
            }
        }else{
            if ($laporan_pelaksanaan_tuga->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                $request->validate([
                    'nomor'=>'required',
                    'kodeUnit'=>'required',
                    'tanggal'=>'required',
                    'hal'=>'required',
                ]);
                if ($request->fileUpload) {
                    $request->validate([
                        'fileUpload'=>'required|mimes:pdf'
                    ]);
                    Storage::delete($laporan_pelaksanaan_tuga->file);
                    $path = $request->file('fileUpload')->store('laporan-pelaksanaan-tugas');
                }
        
                if (isset($path)) {
                    $laporan_pelaksanaan_tuga->update([
                        'nomor'=>$request->nomor,
                        'kodeUnit'=>'KEP-'.$request->nomor. $request->kodeUnit. date('Y', strtotime($request->tanggal)),
                        'tanggal'=>$request->tanggal,
                        'hal'=>$request->hal,
                        'file'=>$path,
                    ]);
                }else{
                    $laporan_pelaksanaan_tuga->update([
                        'nomor'=>$request->nomor,
                        'kodeUnit'=>'KEP-'.$request->nomor. $request->kodeUnit. date('Y', strtotime($request->tanggal)),
                        'tanggal'=>$request->tanggal,
                        'hal'=>$request->hal,
                    ]);
                }
                return  Redirect::back();
            }else{
                abort(403);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\laporanPelaksanaanTugas  $laporanPelaksanaanTugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(laporanPelaksanaanTugas $laporan_pelaksanaan_tuga)
    {
        if ($laporan_pelaksanaan_tuga->created_at->diff(Carbon::now())->days > 0) {
            if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                Storage::delete($laporan_pelaksanaan_tuga->file);
                $laporan_pelaksanaan_tuga->delete();
                return Redirect::back();
            }else{
                abort(403);
            }
        }else{
            if ($laporan_pelaksanaan_tuga->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                Storage::delete($laporan_pelaksanaan_tuga->file);
                $laporan_pelaksanaan_tuga->delete();
                return Redirect::back();
            }else{
                abort(403);
            }
        }
    }
}
