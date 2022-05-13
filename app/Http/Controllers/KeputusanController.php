<?php

namespace App\Http\Controllers;

use App\Models\keputusan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class KeputusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=keputusan::orderby('tanggal', 'desc')->orderby('nomor', 'desc');
        return view('digitalKnowledgeManagement.keputusan',[
            'data'=>$data->Search()->paginate(20)->withQueryString(),
            'search'=>'',
            'title'=> 'TERNATE-HUB || FILE STORAGE',
            'favicon'=>'/img/ico/Digital Knoledge Management.png',
            'keputusan'=>''
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
            'nomor'=>'required',
            'kodeUnit'=>'required',
            'tanggal'=>'required',
            'hal'=>'required',
            'fileUpload'=>'required|mimes:pdf'
        ]);

        $path = $request->file('fileUpload')->store('keputusan');
        
        keputusan::create([
            'nomor'=>$request->nomor,
            'kodeUnit'=>'KEP-'.$request->nomor. $request->kodeUnit. date('Y', strtotime($request->tanggal)),
            'tanggal'=>$request->tanggal,
            'hal'=>$request->hal,
            'file'=>$path,
            'user_id'=>auth()->user()->id
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\keputusan  $keputusan
     * @return \Illuminate\Http\Response
     */
    public function show(keputusan $keputusan)
    {

        return json_encode($keputusan);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\keputusan  $keputusan
     * @return \Illuminate\Http\Response
     */
    public function edit(keputusan $keputusan)
    {
        if ($keputusan->created_at->diff(Carbon::now())->days > 0) {
            return json_encode($keputusan);
        }else{
            if ($keputusan->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                return json_encode($keputusan);
            }else{
                abort(403);
            }
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\keputusan  $keputusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, keputusan $keputusan)
    {
        
        if ($keputusan->created_at->diff(Carbon::now())->days > 0) {
            if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                $request->validate([
                    'nomor'=>'required',
                    'kodeUnit'=>'required',
                    'tanggal'=>'required',
                    'hal'=>'required',
                ]);
                if ($request->fileUpload) {
                    $request->validate([
                        'fileUpload'=>'required|mimes:pdf'
                    ]);
                    Storage::delete($keputusan->file);
                    $path = $request->file('fileUpload')->store('keputusan');
                }
        
                if (isset($path)) {
                    $keputusan->update([
                        'nomor'=>$request->nomor,
                        'kodeUnit'=>'KEP-'.$request->nomor. $request->kodeUnit. date('Y', strtotime($request->tanggal)),
                        'tanggal'=>$request->tanggal,
                        'hal'=>$request->hal,
                        'file'=>$path,
                    ]);
                }else{
                    $keputusan->update([
                        'nomor'=>$request->nomor,
                        'kodeUnit'=>'KEP-'.$request->nomor. $request->kodeUnit. date('Y', strtotime($request->tanggal)),
                        'tanggal'=>$request->tanggal,
                        'hal'=>$request->hal,
                    ]);
                }
                return  Redirect::back();
            }else{
                abort(403);
            }
        }else{
            if ($keputusan->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                $request->validate([
                    'nomor'=>'required',
                    'kodeUnit'=>'required',
                    'tanggal'=>'required',
                    'hal'=>'required',
                ]);
                if ($request->fileUpload) {
                    $request->validate([
                        'fileUpload'=>'required|mimes:pdf'
                    ]);
                    Storage::delete($keputusan->file);
                    $path = $request->file('fileUpload')->store('keputusan');
                }
        
                if (isset($path)) {
                    $keputusan->update([
                        'nomor'=>$request->nomor,
                        'kodeUnit'=>'KEP-'.$request->nomor. $request->kodeUnit. date('Y', strtotime($request->tanggal)),
                        'tanggal'=>$request->tanggal,
                        'hal'=>$request->hal,
                        'file'=>$path,
                    ]);
                }else{
                    $keputusan->update([
                        'nomor'=>$request->nomor,
                        'kodeUnit'=>'KEP-'.$request->nomor. $request->kodeUnit. date('Y', strtotime($request->tanggal)),
                        'tanggal'=>$request->tanggal,
                        'hal'=>$request->hal,
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
     * @param  \App\Models\keputusan  $keputusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(keputusan $keputusan)
    {
        if ($keputusan->created_at->diff(Carbon::now())->days > 0) {
            if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                Storage::delete($keputusan->file);
                $keputusan->delete();
                return Redirect::back();
            }else{
                abort(403);
            }
        }else{
            if ($keputusan->user_id === auth()->user()->id || auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
                Storage::delete($keputusan->file);
                $keputusan->delete();
                return Redirect::back();
            }else{
                abort(403);
            }
        }
    }
}
