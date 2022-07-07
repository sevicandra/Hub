<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statusPenggunaan extends Model
{
    use HasFactory;
    use Uuids;
    
    public function satuanKerja(){
        return $this->belongsTo(satuanKerja::class, 'kodeSatker', 'kodeSatker');
    }

    public function scopeSearch($data){
        if (request('key')) {
            return $data->where('nomor', 'like', '%'.request('key').'%')->orwhere('kodeSatker', 'like', '%'.request('key').'%')->orwherehas('satuanKerja', function($val){
                $val->where('namaSatker', 'like', '%'.request('key').'%');
            });
        }
    }

    protected $fillable = [
        'nomor',
        'KodeSurat',
        'tanggal',
        'kodeSatker',
        'file',
        'Wa_id'
    ];
}
