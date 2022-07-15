<?php

namespace App\Http\Controllers;

use App\Models\whatsappReport;
use App\Http\Requests\StorewhatsappReportRequest;
use App\Http\Requests\UpdatewhatsappReportRequest;

class WhatsappReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('whatsappReport.index',[
            'data'=>whatsappReport::paginate(20)
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
     * @param  \App\Http\Requests\StorewhatsappReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorewhatsappReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\whatsappReport  $whatsappReport
     * @return \Illuminate\Http\Response
     */
    public function show(whatsappReport $whatsappReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\whatsappReport  $whatsappReport
     * @return \Illuminate\Http\Response
     */
    public function edit(whatsappReport $whatsappReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatewhatsappReportRequest  $request
     * @param  \App\Models\whatsappReport  $whatsappReport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatewhatsappReportRequest $request, whatsappReport $whatsappReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\whatsappReport  $whatsappReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(whatsappReport $whatsappReport)
    {
        //
    }
}
