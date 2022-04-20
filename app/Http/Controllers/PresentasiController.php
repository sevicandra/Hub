<?php

namespace App\Http\Controllers;

use App\Models\presentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StorepresentasiRequest;
use App\Http\Requests\UpdatepresentasiRequest;

class PresentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=presentasi::orderby('tanggal', 'desc');
        return view('digitalKnowledgeManagement.presentasi',[
            'data'=>$data->Search()->paginate(20)->withQueryString(),
            'search'=>'',
            'title'=> 'TERNATE-HUB || FILE STORAGE',
            'favicon'=>'/img/ico/Digital Knoledge Management.png',
            'presentasi'=>''
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
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'=>'required',
            'judul'=>'required',
            'fileUpload'=>'required|mimes:pdf,ppt,pptx'
        ]);

        $path = $request->file('fileUpload')->store('presentasi');
        
        presentasi::create([
            'tanggal'=>$request->tanggal,
            'judul'=>$request->judul,
            'file'=>$path,
            'user_id'=>auth()->user()->id
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\presentasi  $presentasi
     * @return \Illuminate\Http\Response
     */
    public function show(presentasi $presentasi)
    {
        if ($presentasi->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
            return json_encode($presentasi);
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\presentasi  $presentasi
     * @return \Illuminate\Http\Response
     */
    public function edit(presentasi $presentasi)
    {
        if ($presentasi->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
            return json_encode($presentasi);
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\presentasi  $presentasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, presentasi $presentasi)
    {
        if ($presentasi->created_at->diff(Carbon::now())->days > 0) {
            if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                $request->validate([
                    'tanggal'=>'required',
                    'judul'=>'required',
                ]);
                if ($request->fileUpload) {
                    $request->validate([
                        'fileUpload'=>'required|mimes:pdf,ppt,pptx'
                    ]);
                    Storage::delete($presentasi->file);
                    $path = $request->file('fileUpload')->store('presentasi');
                }
        
                if (isset($path)) {
                    $presentasi->update([
                        'tanggal'=>$request->tanggal,
                        'judul'=>$request->judul,
                        'file'=>$path,
                    ]);
                }else{
                    $presentasi->update([
                        'tanggal'=>$request->tanggal,
                        'judul'=>$request->judul,
                    ]);
                }
                return  Redirect::back();
            }else{
                abort(403);
            }
        }else{
            if ($presentasi->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                $request->validate([
                    'tanggal'=>'required',
                    'judul'=>'required',
                ]);
                if ($request->fileUpload) {
                    $request->validate([
                        'fileUpload'=>'required|mimes:pdf,ppt,pptx'
                    ]);
                    Storage::delete($presentasi->file);
                    $path = $request->file('fileUpload')->store('presentasi');
                }
        
                if (isset($path)) {
                    $presentasi->update([
                        'tanggal'=>$request->tanggal,
                        'judul'=>$request->judul,
                        'file'=>$path,
                    ]);
                }else{
                    $presentasi->update([
                        'tanggal'=>$request->tanggal,
                        'judul'=>$request->judul,
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
     * @param  \App\Models\presentasi  $presentasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(presentasi $presentasi)
    {
        if ($presentasi->created_at->diff(Carbon::now())->days > 0) {
            if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                Storage::delete($presentasi->file);
                $presentasi->delete();
                return Redirect::back();
            }else{
                abort(403);
            }
        }else{
            if ($presentasi->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                Storage::delete($presentasi->file);
                $presentasi->delete();
                return Redirect::back();
            }else{
                abort(403);
            }
        }
    }
}
