<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\reminder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReminderController extends Controller
{
    public function upcoming()
    {
        return view('reminder.index',[
            'reminder'=>reminder::where('user_id', auth()->user()->id)->orderby('tanggal')->orderby('waktu')->Upcoming()->paginate(20),
            'tujuan'=>User::where('email_verified_at', '!=', null)->get(),
            'upcoming'=>'',
            'favicon'=>'/img/ico/reminder.png'
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'tanggal'=>'required',
            'waktu'=>'required',
            'pesan'=>'required',
            'tujuan'=>'required'
        ]);
        $reminder=reminder::create([
            'user_id'=>auth()->user()->id,
            'tanggal'=>$request->tanggal,
            'waktu'=>$request->waktu,
            'pesan'=>$request->pesan,
        ]);
        foreach ($request->tujuan as $key) {
            $reminder->tujuan()->attach($key);
        }
        return Redirect::back();
    }

    public function recent()
    {
        return view('reminder.index',[
            'reminder'=>reminder::where('user_id', auth()->user()->id)->orderby('tanggal')->orderby('waktu')->Recent()->paginate(20),
            'tujuan'=>User::where('email_verified_at', '!=', null)->get(),
            'recent'=>'',
            'favicon'=>'/img/ico/reminder.png'
        ]);
    }

    public function delete(reminder $reminder)
    {
        if ($reminder->user_id === auth()->user()->id) {
            if ($reminder->tanggal === Carbon::now()->isoFormat('YYYY-MM-DD') && $reminder->waktu > Carbon::now()->isoFormat('HH:mm:ss')) {
                $reminder->tujuan()->detach();
                $reminder->delete();
                return Redirect::back();
            }elseif($reminder->tanggal > Carbon::now()->isoFormat('YYYY-MM-DD')){
                $reminder->tujuan()->detach();
                $reminder->delete();
                return Redirect::back();
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }
    }

    public function view(reminder $reminder)
    {
        $reminder->pengirim;
        $reminder->tujuan;
        return json_encode($reminder);
    }

    public function reminder()
    {
        return view('reminder.home',[
            'reminder'=>reminder::where('user_id', auth()->user()->id)->orderby('tanggal')->orderby('waktu')->Reminder()->paginate(20),
            'tujuan'=>User::where('email_verified_at', '!=', null)->get(),
            'home'=>'',
            'favicon'=>'/img/ico/reminder.png'
        ]);
    }
}
