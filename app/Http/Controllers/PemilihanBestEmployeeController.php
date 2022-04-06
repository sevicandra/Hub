<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\nominasiBestEmployee;
use App\Models\pemilihanBestEmployee;
use Illuminate\Support\Facades\Redirect;


class PemilihanBestEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bestemployee.index',[
            'data'=>pemilihanBestEmployee::orderby('tahun', 'desc')->orderby('bulan', 'desc')->get(),
            'nominasi'=>User::where('email_verified_at', '!=', null)->get(),
            'index'=>'',
            'title'=> 'Ternate-Hub || Best Employee',
            'favicon'=>'/img/ico/bestemployee.png'
        ]);
    }

    public function pemilihan(){
        return view('bestemployee.survei',[
            'data'=>pemilihanBestEmployee::where('status', '2')->orderby('tahun', 'asc')->orderby('bulan', 'asc')->first(),
            'pemilihan'=>'',
            'title'=> 'Ternate-Hub || Best Employee',
            'favicon'=>'/img/ico/bestemployee.png'
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
        if (auth()->user()->jabatan === '01' ||auth()->user()->jabatan === '02' || auth()->user()->jabatan === '11'){
            $validatedData=$request->validate([
                'bulan'=>'required',
                'tahun'=>'required',
            ]);
            pemilihanBestEmployee::create($validatedData);
            return Redirect::back();
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemilihanBestEmployee  $pemilihanBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(pemilihanBestEmployee $best_employee)
    {
        $nominasi=[];
        foreach ($best_employee->listnominasi as $key) {
            
            $nama=$key->user->nama;
            $produktifitasKerja=$key->hasilPemilihan->sum('produktifitasKerja');
            $sikapKerja=$key->hasilPemilihan->sum('sikapKerja');
            $kedisiplinan=$key->hasilPemilihan->sum('kedisiplinan');
            $responden=$key->hasilPemilihan->count();
            if ($responden === 0) {
                $responden=1;
            }
            array_push($nominasi, ['nominasi_id'=>$key->id, 'nama'=>$nama, 'produktifitasKerja'=>$produktifitasKerja,'sikapKerja'=>$sikapKerja, 'kedisiplinan'=>$kedisiplinan, 'total' =>number_format(($produktifitasKerja+$sikapKerja+$kedisiplinan)/$responden, 2, ',', '.')]);
        }

        
        return json_encode(['pemilihan'=>$best_employee, 'nominasi'=>$nominasi,'user'=>Auth()->user()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemilihanBestEmployee  $pemilihanBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(pemilihanBestEmployee $best_employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\pemilihanBestEmployee  $pemilihanBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pemilihanBestEmployee $best_employee)
    {
        if (auth()->user()->jabatan === '01' ||auth()->user()->jabatan === '02' || auth()->user()->jabatan === '11'){
            switch ($request->action) {
                
                case 'nominasi':
                    if ($best_employee->status === '1') {
                        foreach ($request->nominasi as $key ) {
                                if (nominasiBestEmployee::where('pemilihan_best_employee_id', $best_employee->id)->where('user_id', $key)->first()) {
                                }else{
                                    nominasiBestEmployee::create([
                                        'pemilihan_best_employee_id'=>$best_employee->id,
                                        'user_id'=>$key
                                    ]);

                                }
                            }
                            return Redirect::back();
                    }else{
                        abort(403);
                    }
                    break;
                
                case 'mulaiSurvei':
                    if ($best_employee->status === '1') {
                        $best_employee->update(['status'=>'2']);
                        return Redirect::back();

                    }else{
                        abort(403);
                    }
                    break;
    
                case 'tutupSurvei':
                    if ($best_employee->status === '2') {
                        $best_employee->update(['status'=>"3"]);
                        return Redirect::back();
                    }else{
                        abort(403);
                    }
                    
                    break;
                
                default:
                    abort(404);
                    break;
            }
        }else{
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemilihanBestEmployee  $pemilihanBestEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemilihanBestEmployee $pemilihanBestEmployee)
    {
        //
    }
}
