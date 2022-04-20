<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notula extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = ['user_id', 'tanggalNotula', 'tanggalRapat', 'file', 'agendaRapat'];
    public function scopeSearch($data){
        if (request('key')) {
            return $data->where('agendaRapat', 'like', '%'.request('key').'%');
        }
    }
}
