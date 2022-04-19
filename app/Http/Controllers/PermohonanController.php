<?php

namespace App\Http\Controllers;

use App\Models\tiket;
use App\Models\barang;
use App\Models\permohonan;
use App\Models\satuanKerja;
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
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12') {
            return view('pindai.Permohonan',[
                'data'=>permohonan::orderBy('tanggalSurat', 'desc')->Search()->paginate(20)->withQueryString(),
                'permohonanview'=>'',
                'title'=> 'TERNATE-HUB || PINDAI',
                'favicon'=>'/img/ico/pindai.png',
                'search'=>''
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
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12') {
            $ValidatedData=$request->validate([
                'nomorSurat'=>'required',
                'hal'=>'required',
                'tanggalSurat'=>'required',
                'pemohon'=>'required|numeric|digits:6',
                'tanggalDiTerima'=>'required',
            ]);
            if (satuanKerja::where('kodeSatker', $ValidatedData['pemohon'])->first())  {
                if (satuanKerja::where('kodeSatker', $ValidatedData['pemohon'])->first()->profil) {
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
                    $tiketbaru = tiket::create([
                        'tiket'=>$tiket,
                        'permohonan'=>1,
                        'jenis'=>'PKN'
                    ]);
                        
                    permohonan::create([
                        'nomorSurat'=> $ValidatedData['nomorSurat'],
                        'hal'=> $ValidatedData['hal'],
                        'tanggalSurat'=> $ValidatedData['tanggalSurat'],
                        'pemohon'=> $ValidatedData['pemohon'],
                        'tanggalDiTerima'=> $ValidatedData['tanggalDiTerima'],
                        'tiket_id'=> $tiketbaru->id,
                        'jenis'=> 'PKN',
                    ]);
                    return redirect('/permohonan');
                }else{
                    return 'Profil Satker Tidak Ditemukan Mohon Lengkapi Profil Satker Terlebih Dahulu';
                }
            }else{
                return 'Data Satker Tidak Ditemukan Mohon Lengkapi Profil Satker Terlebih Dahulu';
            }
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function show(permohonan $permohonan)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12') {
            return view('pindai.Barang',[
                'data'=>$permohonan,
                'title'=> 'TERNATE-HUB || PINDAI',
                'favicon'=>'/img/ico/pindai.png'
            ]);
        }else{
            abort(403);
        }
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
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02' || auth()->user()->jabatan === '09' || auth()->user()->jabatan === '10' || auth()->user()->jabatan === '11') {
            $i=0;   
            foreach ($request->barang as $key) {
                barang::where('id', $key)->update([
                    'laporan_penilaian_id'=>$request->laporan_penilaian_id,
                    'nilaiWajar'=>$request->value[$i]
                ]);
                $i++;
            }
            return redirect('/penilaian/'. $permohonan->permohonanPenilaian->id );
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function destroy(permohonan $permohonan)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '03' || auth()->user()->jabatan === '12') {
            if ($permohonan->tiket->permohonan === 1) {
                $permohonan->tiket->update(['permohonan' => 0]);
                $barang=$permohonan->barang;
                foreach($barang as $b){
                    $b->delete();
                };
                $permohonan->delete();
                return redirect('/permohonan');
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }
    }
}
