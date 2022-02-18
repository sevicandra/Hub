<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\target;
use App\Models\capaian;
use Illuminate\Http\Request;
use App\Models\idikatorKinerjaUtama;


class kinerja extends Controller
{
    public function inputTarget(Request $request){
        $i=0;
        foreach ($request->periode as $key) {
            $data['idikator_kinerja_utama_id']=$request->idikator_kinerja_utama_id;
            $data['periode']=$request->periode[$i];
            $data['target']=$request->target[$i];
            $data['raw']=$request->raw[$i];
            $i++;
            target::create($data);
        }
        $request->session()->flash('message', 'Successfully updated!');
        return redirect($request->session()->get('_previous')['url']);
    }

    public function updateTarget(Request $request){
        $i=0;
        $IKU = idikatorKinerjaUtama::find($request->idikator_kinerja_utama_id);
        foreach($request->periode as $key){
            $target = $IKU->target->where('periode', $key)->first();
            if ($target) {
                $target2 = $request->target[$i];
                $raw = $request->raw[$i];
                $target->update([
                    'target'=>$target2,
                    'raw'=>$raw
                ]);
            }else{
                $data['idikator_kinerja_utama_id']=$request->idikator_kinerja_utama_id;
                $data['periode']=$request->periode[$i];
                $data['target'] = $request->target[$i];
                $data['raw'] = $request->raw[$i];
                target::create($data);
            }
            $request->session()->flash('message', 'Successfully updated!');
            return redirect($request->session()->get('_previous')['url']);
        }
    }

    public function inputCapaian(Request $request){
        
        $ValidatedData=$request->validate([
            'idikator_kinerja_utama_id'=>'required',
            'bulan'=>'required',
            'capaian'=>'required',
            'raw'=>'nullable',
        ]);
        capaian::create($ValidatedData);
        return redirect($request->session()->get('_previous')['url']);
    }

    public function monitoring(){
        return view('praktisMonitoring', [
            'data'=> User::all()
        ]);

    }

    public function monitoringindividu(User $monitoring){
        return view('praktisHome',[
            'data'=>$monitoring->IKU,
            'user'=>$monitoring->id
        ]);

    }

    public function hapusCapkin(capaian $capkin){
        if ($capkin->IKU->user->id === auth()->user()->id) {
            $capkin->delete();
            return redirect('praktis/'. $capkin->IKU->id);
        }else{
            abort(403);
        }
    }
}
