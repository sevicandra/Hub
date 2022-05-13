<?php

namespace App\Http\Controllers;

use App\Models\notula;
use App\Models\keputusan;
use App\Models\presentasi;
use Illuminate\Http\Request;
use App\Models\laporanPelaksanaanTugas;

class FileStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('digitalKnowledgeManagement.index',[
            'title'=> 'TERNATE-HUB || FILE STORAGE',
            'favicon'=>'/img/ico/Digital Knoledge Management.png',
            'fileStorage'=>'',
            'suratKeputusan'=>keputusan::all(),
            'suratKeputusanThisMonth'=>keputusan::whereMonth('created_at', date('m')),
            'suratKeputusanLastMonth'=>keputusan::whereMonth('created_at', date('m')-1),
            'presentasi'=>presentasi::all(),
            'presentasiThisMonth'=>presentasi::whereMonth('created_at', date('m')),
            'presentasiLastMonth'=>presentasi::whereMonth('created_at', date('m')-1),
            'laporanPelaksanaanTugas'=>laporanPelaksanaanTugas::all(),
            'laporanPelaksanaanTugasThisMonth'=>laporanPelaksanaanTugas::whereMonth('created_at', date('m')),
            'laporanPelaksanaanTugasLastMonth'=>laporanPelaksanaanTugas::whereMonth('created_at', date('m')-1),
            'notula'=>notula::all(),
            'notulaThisMonth'=>notula::whereMonth('created_at', date('m')),
            'notulaLastMonth'=>notula::whereMonth('created_at', date('m')-1),
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
