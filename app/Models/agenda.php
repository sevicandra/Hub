<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class agenda extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable=[
        'agenda',
        'tempat',
        'tanggal',
        'waktu',
        'meetingId',
        'meetingPassword',
        'linkRapat',
        'linkAbsensi',
        'user_id',
        'notification'
    ];

    public function scopeNotification($data){
        return $data->where('waktu', '>', Carbon::now()->isoFormat('H:mm:ss'))->where('waktu', '<', Carbon::now()->addMinutes(30)->isoFormat('H:mm:ss'));
    }
    
}
