<?php

namespace App\Models;

use App\Traits\Uuids;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reminder extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        'user_id',
        'tanggal',
        'waktu',
        'pesan',
        'notifikasi'
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tujuan()
    {
        return $this->belongsToMany(User::class, 'tujuan_reminders', 'reminder_id', 'user_id');
    }

    public function scopeUpcoming($data)
    {
        return $data->where(function($val){
            $val->where('tanggal', Carbon::now()->isoFormat('YYYY-MM-DD'))->where('waktu', '>' ,Carbon::now()->isoFormat('HH:mm:ss'));
        })->orwhere(function($val){
            $val->where('tanggal', '>', Carbon::now()->isoFormat('YYYY-MM-DD'));
        })->get();
    }

    public function scopeRecent($data)
    {
        return $data->where(function($val){
            $val->where('tanggal', Carbon::now()->isoFormat('YYYY-MM-DD'))->where('waktu', '<' ,Carbon::now()->isoFormat('HH:mm:ss'));
        })->orwhere(function($val){
            $val->where('tanggal', '<', Carbon::now()->isoFormat('YYYY-MM-DD'));
        })->orderby('tanggal')->get();
    }
    
    public function scopeNotification($data)
    {
        return $data->where('notifikasi', true)->where('tanggal', Carbon::now()->isoFormat('YYYY-MM-DD'))->where('waktu', '>', Carbon::now()->isoFormat('H:mm:ss'))->where('waktu', '<', Carbon::now()->addMinutes(2)->isoFormat('H:mm:ss'))->get();
    }
}
