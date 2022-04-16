<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keputusan extends Model
{
    use Uuids;
    use HasFactory;
    protected $fillable = ['nomor', 'tanggal', 'hal', 'file', 'user_id', 'kodeUnit'];

    public function scopeSearch($data){
        if (request('key')) {
            return $data->where('kodeUnit', 'like', '%'.request('key').'%')->orwhere('hal', 'like', '%'.request('key').'%');
        }
    }
}
