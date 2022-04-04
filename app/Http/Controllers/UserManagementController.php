<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserManagementController extends Controller
{
    public function index(){
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
            return view('manajemenUser.index',[
                'data'=>User::where('email_verified_at', '!=', null)->get(),
                'title'=> 'TERNATE-HUB || USER MANAGEMENT',
                'favicon'=>'/img/ico/usermanagement.png'
            ]);
        }else{
            abort(403);
        }
    }

    public function show(User $user_management)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
            return json_encode($user_management) ;
        }else{
            abort(403);
        }
    }

    public function update(Request $request, User $user_management)
    {
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
            
            $validatedData=$request->validate([
                'Nama'=>'required',
                'NIP'=>'required',
                'pangkatGolongan'=>'required',
                'jabatan'=>'required'
            ]);
            $user_management->update($validatedData);
            return Redirect::back();
        }else{
            abort(403);
        }
    }

    public function destroy(User $user_management){
        if (auth()->user()->jabatan === '01' || auth()->user()->jabatan === '02') {
            $user_management->update(['email_verified_at'=>null]);
            return Redirect::back();
        }else{
            abort(403);
        }
    }

}
