<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\target;
use App\Models\capaian;
use Illuminate\Http\Request;
use App\Models\kinerjaOrganisasi;
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
            $data['jeniskinerja']=$request->jenisKinerja;
            $i++;
            target::create($data);
        }
        $request->session()->flash('message', 'Successfully updated!');
        return redirect($request->session()->get('_previous')['url']);
    }

    public function updateTarget(Request $request){
        $i=0;
        if(idikatorKinerjaUtama::find($request->idikator_kinerja_utama_id)){
            $IKU = idikatorKinerjaUtama::find($request->idikator_kinerja_utama_id);
        }elseif(kinerjaOrganisasi::find($request->idikator_kinerja_utama_id)){
            $IKU = kinerjaOrganisasi::find($request->idikator_kinerja_utama_id);
        };
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
                $data['jeniskinerja']=$request->jenisKinerja;
                target::create($data);
            }
            $i++;
        }
        $request->session()->flash('message', 'Successfully updated!');
        return redirect($request->session()->get('_previous')['url']);
    }

    public function inputCapaian(Request $request){
        $ValidatedData=$request->validate([
            'idikator_kinerja_utama_id'=>'required',
            'bulan'=>'required',
            'capaian'=>'required',
            'raw'=>'nullable',
            'jeniskinerja'=>'required'
        ]);
        capaian::create($ValidatedData);
        return redirect($request->session()->get('_previous')['url']);
    }

    public function monitoring(){
        if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15') {
            return view('praktis.Monitoring', [
                'data'=> User::where('email_verified_at', '!=', null)->orderBy('jabatan')->get(),
                'title'=> 'TERNATE-HUB || PRAKTIS',
                'favicon'=>'/img/ico/praktis.png'
            ]);
        }else{
            abort(403);
        }
    }

    public function monitoringindividu(User $monitoring){
        if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15') {
            return view('praktis.Home',[
                'data'=>$monitoring->IKU->where('tahun', session()->get('tahun')),
                'user'=>$monitoring->id,
                'back'=>'monitoring',
                'monitoring'=>true,
                'title'=> 'TERNATE-HUB || PRAKTIS',
                'favicon'=>'/img/ico/praktis.png'
            ]);
        }else{
            abort(403);
        }
    }

    public function hapusCapkin(capaian $capkin){
        if ($capkin->jeniskinerja === 'App\Models\idikatorKinerjaUtama') {
            if ($capkin->IKU->user->id === auth()->user()->id) {
                $capkin->delete();
                return redirect('praktis/'. $capkin->IKU->id);
            }else{
                abort(403);
            }
        }elseif($capkin->jeniskinerja === 'App\Models\kinerjaOrganisasi'){
            if (auth()->user()->jabatan === '01'||auth()->user()->jabatan === '06'||auth()->user()->jabatan === '15') {
                $capkin->delete();
                return redirect('kinerjaorganisasi/'. $capkin->IKU->id);
            }else{
                abort(403);
            }
        }else{
            abort(404);
        }
    }
}
