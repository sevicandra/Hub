<?php

namespace App\Http\Controllers;

use App\Models\notula;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorenotulaRequest;
use App\Http\Requests\UpdatenotulaRequest;

class NotulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=notula::orderby('tanggalNotula', 'desc')->orderby('tanggalRapat', 'desc');
        return view('digitalKnowledgeManagement.notula',[
            'data'=>$data->Search()->paginate(20)->withQueryString(),
            'search'=>'',
            'title'=> 'TERNATE-HUB || FILE STORAGE',
            'favicon'=>'/img/ico/Digital Knoledge Management.png',
            'notula'=>''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'tanggalNotula'=>'required',
            'tanggalRapat'=>'required',
            'agendaRapat'=>'required',
            'fileUpload'=>'required|mimes:pdf'
        ]);

        $path = $request->file('fileUpload')->store('notula');
        
        notula::create([
            'tanggalNotula'=>$request->tanggalNotula,
            'tanggalRapat'=>$request->tanggalRapat,
            'agendaRapat'=>$request->agendaRapat,
            'file'=>$path,
            'user_id'=>auth()->user()->id
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notula  $notula
     * @return \Illuminate\Http\Response
     */
    public function show(notula $notula)
    {
        return json_encode($notula);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notula  $notula
     * @return \Illuminate\Http\Response
     */
    public function edit(notula $notula)
    {
        if ($notula->created_at->diff(Carbon::now())->days > 0) {
            return json_encode($notula);
        }else{
            if ($notula->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                return json_encode($notula);
            }else{
                abort(403);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\notula  $notula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notula $notula)
    {
        if ($notula->created_at->diff(Carbon::now())->days > 0) {
            if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                $request->validate([
                    'tanggalNotula'=>'required',
                    'tanggalRapat'=>'required',
                    'agendaRapat'=>'required',
                ]);
                if ($request->fileUpload) {
                    $request->validate([
                        'fileUpload'=>'required|mimes:pdf'
                    ]);
                    Storage::delete($notula->file);
                    $path = $request->file('fileUpload')->store('notula');
                }
        
                if (isset($path)) {
                    $notula->update([
                        'tanggalNotula'=>$request->tanggalNotula,
                        'tanggalRapat'=>$request->tanggalRapat,
                        'agendaRapat'=>$request->agendaRapat,
                        'file'=>$path,
                    ]);
                }else{
                    $notula->update([
                        'tanggalNotula'=>$request->tanggalNotula,
                        'tanggalRapat'=>$request->tanggalRapat,
                        'agendaRapat'=>$request->agendaRapat,
                    ]);
                }
                return  Redirect::back();
            }else{
                abort(403);
            }
        }else{
            if ($notula->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                $request->validate([
                    'tanggalNotula'=>'required',
                    'tanggalRapat'=>'required',
                    'agendaRapat'=>'required',
                ]);
                if ($request->fileUpload) {
                    $request->validate([
                        'fileUpload'=>'required|mimes:pdf'
                    ]);
                    Storage::delete($notula->file);
                    $path = $request->file('fileUpload')->store('notula');
                }
        
                if (isset($path)) {
                    $notula->update([
                        'tanggalNotula'=>$request->tanggalNotula,
                        'tanggalRapat'=>$request->tanggalRapat,
                        'agendaRapat'=>$request->agendaRapat,
                        'file'=>$path,
                    ]);
                }else{
                    $notula->update([
                        'tanggalNotula'=>$request->tanggalNotula,
                        'tanggalRapat'=>$request->tanggalRapat,
                        'agendaRapat'=>$request->agendaRapat,
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
     * @param  \App\Models\notula  $notula
     * @return \Illuminate\Http\Response
     */
    public function destroy(notula $notula)
    {
        if ($notula->created_at->diff(Carbon::now())->days > 0) {
            if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                Storage::delete($notula->file);
                $notula->delete();
                return Redirect::back();
            }else{
                abort(403);
            }
        }else{
            if ($notula->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                Storage::delete($notula->file);
                $notula->delete();
                return Redirect::back();
            }else{
                abort(403);
            }
        }
    }
}
