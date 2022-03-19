<?php

namespace App\Http\Controllers;

use App\Models\pnbp;
use Illuminate\Http\Request;
use App\Http\Requests\StorepnbpRequest;
use App\Http\Requests\UpdatepnbpRequest;
use Illuminate\Support\Facades\Redirect;

class PnbpController extends Controller
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
            'target'=>'required',
            'jenis'=>'required|unique:pnbps,jenis,NULL,id,tahun,' . $request->session()->get('tahun'),
            
        ]);
        $validatedData['tahun']=$request->session()->get('tahun');
        pnbp::create($validatedData);
        return redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pnbp  $pnbp
     * @return \Illuminate\Http\Response
     */
    public function show(pnbp $pnbp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pnbp  $pnbp
     * @return \Illuminate\Http\Response
     */
    public function edit(pnbp $pnbp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\pnbp  $pnbp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pnbp $pnbp)
    {
        $validatedData= $request->validate([
            'target'=>'required',
        ]);
        $pnbp->update($validatedData);
        return redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pnbp  $pnbp
     * @return \Illuminate\Http\Response
     */
    public function destroy(pnbp $pnbp)
    {
        //
    }
}
