<?php

namespace App\Http\Controllers;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class registerController extends Controller
{
    public function store(Request $request){
        $ValidatedData=$request->validate(
            [
                'Nama'=>'required|max:255',
                'NIP'=>'required|min:18|max:18|unique:users',
                'email'=>'required|email|unique:users',
                'password'=>'required|min:8|max:255',
                'pangkatGolongan'=>'required',
                'jabatan'=>'required'
            ]);
            $ValidatedData['password'] = Hash::make($ValidatedData['password']);
            user::create($ValidatedData);
            $request->session()->flash('success', 'Registration Success');
            return redirect('/login');
    }
}
