<?php

namespace App\Http\Controllers;

use App\Models\pnbp;
use App\Models\capaianPnbp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorecapaianPnbpRequest;
use App\Http\Requests\UpdatecapaianPnbpRequest;

class CapaianPnbpController extends Controller
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
        if (pnbp::all()->find($request->pnbp_id)->jenis === 'PKN') {
            if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '03'||auth()->user()->jabatan === '12') {
                $validatedData = $request->validate([
                    'pnbp_id'=>'required',
                    'bulan'=>'required',
                    'capaian'=>'required'
                ]);
                capaianPnbp::create($validatedData);
                return redirect::back();
            }else{
                return abort(403);
            }
        }elseif (pnbp::all()->find($request->pnbp_id)->jenis === 'LLG') {
            if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '02'||auth()->user()->jabatan === '07'||auth()->user()->jabatan === '09'||auth()->user()->jabatan === '11') {
                $validatedData = $request->validate([
                    'pnbp_id'=>'required',
                    'bulan'=>'required',
                    'capaian'=>'required'
                ]);
                capaianPnbp::create($validatedData);
                return redirect::back();
            }else{
                return abort(403);
            }
        }elseif (pnbp::all()->find($request->pnbp_id)->jenis === 'PPN') {
            if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '04'||auth()->user()->jabatan === '05'||auth()->user()->jabatan === '13'||auth()->user()->jabatan === '14') {
                $validatedData = $request->validate([
                    'pnbp_id'=>'required',
                    'bulan'=>'required',
                    'capaian'=>'required'
                ]);
                capaianPnbp::create($validatedData);
                return redirect::back();
            }else{
                return abort(403);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\capaianPnbp  $capaianPnbp
     * @return \Illuminate\Http\Response
     */
    public function show(capaianPnbp $capaianPnbp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\capaianPnbp  $capaianPnbp
     * @return \Illuminate\Http\Response
     */
    public function edit(capaianPnbp $capaianPnbp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecapaianPnbpRequest  $request
     * @param  \App\Models\capaianPnbp  $capaianPnbp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecapaianPnbpRequest $request, capaianPnbp $capaianPnbp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\capaianPnbp  $capaianPnbp
     * @return \Illuminate\Http\Response
     */
    public function destroy(capaianPnbp $capaianPnbp)
    {   
        if ($capaianPnbp->target->jenis === 'PKN') {
            if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '03'||auth()->user()->jabatan === '12') {
                $capaianPnbp->delete();
                return redirect::back();                
            }else{
                return abort(403);
            }
        }elseif ($capaianPnbp->target->jenis === 'LLG') {
            if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '02'||auth()->user()->jabatan === '07'||auth()->user()->jabatan === '09'||auth()->user()->jabatan === '11') {
                $capaianPnbp->delete();
                return redirect::back();                
            }else{
                return abort(403);
            }
        }elseif ($capaianPnbp->target->jenis === 'PPN') {
            if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '04'||auth()->user()->jabatan === '05'||auth()->user()->jabatan === '13'||auth()->user()->jabatan === '14') {
                $capaianPnbp->delete();
                return redirect::back();
            }else{
                return abort(403);
            }
        }
    }
}
