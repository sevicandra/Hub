<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\idikatorKinerjaUtama;
use App\Http\Requests\StoreidikatorKinerjaUtamaRequest;
use App\Http\Requests\UpdateidikatorKinerjaUtamaRequest;

class IdikatorKinerjaUtamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('praktisHome',[
            'data' => auth()->user()->IKU,
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
    public function store(Request $prakti)
    {
        $ValidatedData=$prakti->validate(
            [
                'KodeIKU'=>'required',
                'namaIKU'=>'required',
                'konsolidasi'=>'required',
                'polarisasi'=>'required'
            ]);
        $ValidatedData['tahun'] = $prakti->session()->get('tahun');
        $ValidatedData['user_id'] = auth()->user()->id;
        idikatorKinerjaUtama::create($ValidatedData);
        return redirect($prakti->session()->get('_previous')['url']);  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\idikatorKinerjaUtama  $idikatorKinerjaUtama
     * @return \Illuminate\Http\Response
     */
    public function show(idikatorKinerjaUtama $prakti)
    {

        return view('praktisCapaian',[
            'data' => $prakti,
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\idikatorKinerjaUtama  $idikatorKinerjaUtama
     * @return \Illuminate\Http\Response
     */
    public function edit(idikatorKinerjaUtama $idikatorKinerjaUtama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateidikatorKinerjaUtamaRequest  $request
     * @param  \App\Models\idikatorKinerjaUtama  $idikatorKinerjaUtama
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateidikatorKinerjaUtamaRequest $request, idikatorKinerjaUtama $idikatorKinerjaUtama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\idikatorKinerjaUtama  $idikatorKinerjaUtama
     * @return \Illuminate\Http\Response
     */
    public function destroy(idikatorKinerjaUtama $prakti)
    {
        if($prakti->user_id === auth()->user()->id){
            $prakti->delete();
            return redirect('praktis');
        }else{
            abort(403);
        }
    }
}
