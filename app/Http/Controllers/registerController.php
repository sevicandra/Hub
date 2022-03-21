<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class registerController extends Controller
{
    public function store(Request $request){
        $messages = [
            'NIP.unique' => 'NIP Sudah Didaftarkan',
            'email.unique' => 'Email Sudah Didaftarkan',
        ];
        $ValidatedData=$request->validate(
            [
                'Nama'=>'required|max:255',
                'NIP'=>'required|min:18|max:18|unique:users',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:8|max:255',
                'pangkatGolongan'=>'required',
                'jabatan'=>'required'
            ], $messages);
            $ValidatedData['password'] = Hash::make($ValidatedData['password']);
            $user = user::create($ValidatedData);
            event(new Registered($user));
            return redirect('/login');
    }
}
