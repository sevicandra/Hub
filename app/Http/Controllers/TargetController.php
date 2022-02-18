<?php

namespace App\Http\Controllers;

use App\Models\target;
use App\Http\Requests\StoretargetRequest;
use App\Http\Requests\UpdatetargetRequest;

class TargetController extends Controller
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
     * @param  \App\Http\Requests\StoretargetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretargetRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\target  $target
     * @return \Illuminate\Http\Response
     */
    public function show(target $target)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\target  $target
     * @return \Illuminate\Http\Response
     */
    public function edit(target $target)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetargetRequest  $request
     * @param  \App\Models\target  $target
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetargetRequest $request, target $target)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\target  $target
     * @return \Illuminate\Http\Response
     */
    public function destroy(target $target)
    {
        //
    }
}
