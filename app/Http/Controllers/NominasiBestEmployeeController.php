<?php

namespace App\Http\Controllers;

use App\Models\nominasiBestEmployee;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorenominasiBestEmployeeRequest;
use App\Http\Requests\UpdatenominasiBestEmployeeRequest;

class NominasiBestEmployeeController extends Controller
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
     * @param  \App\Http\Requests\StorenominasiBestEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorenominasiBestEmployeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nominasiBestEmployee  $nominasiBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(nominasiBestEmployee $nominasiBestEmployee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nominasiBestEmployee  $nominasiBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(nominasiBestEmployee $nominasiBestEmployee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatenominasiBestEmployeeRequest  $request
     * @param  \App\Models\nominasiBestEmployee  $nominasiBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatenominasiBestEmployeeRequest $request, nominasiBestEmployee $nominasiBestEmployee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nominasiBestEmployee  $nominasiBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(nominasiBestEmployee $nominasiBestEmployee)
    {
        if (auth()->user()->jabatan === '02' || auth()->user()->jabatan === '11'){
            if ($nominasiBestEmployee->pemilihan->status === '1' ) {
                $nominasiBestEmployee->delete();
                return Redirect::back();
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }
    }
}
