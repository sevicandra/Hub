<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rekapitulasiBestEmployee;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorerekapitulasiBestEmployeeRequest;
use App\Http\Requests\UpdaterekapitulasiBestEmployeeRequest;

class RekapitulasiBestEmployeeController extends Controller
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
        foreach ($request->nominasi as $key) {
            rekapitulasiBestEmployee::create([
                'nominasi_best_employee_id'=>$key,
                'user_id'=>auth()->user()->id,
                'produktifitasKerja'=>explode('.', $request->produktifitasKerja[$key])[0],
                'kedisiplinan'=>explode('.', $request->kedisiplinan[$key])[0],
                'sikapKerja'=>explode('.', $request->sikapKerja[$key])[0],
            ]);
        }  
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rekapitulasiBestEmployee  $rekapitulasiBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(rekapitulasiBestEmployee $rekapitulasiBestEmployee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rekapitulasiBestEmployee  $rekapitulasiBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(rekapitulasiBestEmployee $rekapitulasiBestEmployee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdaterekapitulasiBestEmployeeRequest  $request
     * @param  \App\Models\rekapitulasiBestEmployee  $rekapitulasiBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdaterekapitulasiBestEmployeeRequest $request, rekapitulasiBestEmployee $rekapitulasiBestEmployee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rekapitulasiBestEmployee  $rekapitulasiBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(rekapitulasiBestEmployee $rekapitulasiBestEmployee)
    {
        //
    }
}
