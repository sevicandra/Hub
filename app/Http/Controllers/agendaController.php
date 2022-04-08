<?php

namespace App\Http\Controllers;

use App\Models\agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class agendaController extends Controller
{
    public function daftaragenda(Request $request){
        $agenda = agenda::whereDate('tanggal', '=', $request->dates)->orderBy('waktu')->get();
        
        return json_encode([$agenda,
            'user'=>auth()->user()->id
        ]);
    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'agenda'=>'required|min:0|max:50',
            'tanggal'=>'required',
            'tempat'=>'required',
            'waktu'=>'required',
        ]);

        agenda::create([
            'agenda'=>$request->agenda,
            'tempat'=>$request->tempat,
            'tanggal'=>$request->tanggal,
            'waktu'=>$request->waktu,
            'meetingId'=>$request->meetingId,
            'meetingPassword'=>$request->meetingPassword,
            'linkRapat'=>$request->linkRapat,
            'linkAbsensi'=>$request->linkAbsensi,
            'user_id'=>auth()->user()->id,
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(agenda $agenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, agenda $agenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(agenda $agenda)
    {
        if ($agenda->user_id === auth()->user()->id) {
            $agenda->delete();
            return Redirect::back();
        }else{
            abort(403);
        }
    }
}
