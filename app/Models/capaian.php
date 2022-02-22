<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class capaian extends Model
{
    use Uuids;
    use HasFactory;

    public function IKU(){
        return $this->morphTo(__FUNCTION__, 'jeniskinerja', 'idikator_kinerja_utama_id');
    }

    protected $fillable=[
        'idikator_kinerja_utama_id',
        'bulan',
        'capaian',
        'raw',
        'jeniskinerja'
    ];

}
