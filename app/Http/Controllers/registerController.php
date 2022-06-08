<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class registerController extends Controller
{
    public function store(Request $request){
        $request['nomorHP']= "62". $request['nomorHP'];
        $messages = [
            'NIP.unique' => 'NIP Sudah Didaftarkan',
            'email.unique' => 'Email Sudah Didaftarkan',
            'nomorHP.unique' => 'Nomor HP Sudah Didaftarkan',
            'nomorHP.numeric' => 'Nomor HP Hanya Boleh Berupa Nomor',
        ];
        $ValidatedData=$request->validate(
            [
                'Nama'=>'required|max:255',
                'NIP'=>'required|min:18|max:18|unique:users',
                'email'=>'required|email|unique:users',
                'nomorHP'=>'required|numeric|unique:users',
                'password'=>'required|min:8|max:255',
                'pangkatGolongan'=>'required',
                'jabatan'=>'required'
            ], $messages);

            $ValidatedData['password'] = Hash::make($ValidatedData['password']);
            $user = user::create([
                'Nama'=>$ValidatedData['Nama'],
                'NIP'=>$ValidatedData['NIP'],
                'email'=>$ValidatedData['email'],
                'nomorHP'=> $ValidatedData['nomorHP'],
                'password'=>$ValidatedData['password'],
                'pangkatGolongan'=>$ValidatedData['pangkatGolongan'],
                'jabatan'=>$ValidatedData['jabatan']
            ]);
            return redirect('/login');
    }
}
