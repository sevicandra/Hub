<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class rencanaAksi extends Model
{
    use Uuids;
    use HasFactory;

    public function idikatorKinerjaUtama(){
        return $this->belongsTo(idikatorKinerjaUtama::class);
    }


    protected $fillable = [
        'rencanaAksi',
        'tanggalMulai',
        'tanggalSelesai',
        'idikator_kinerja_utama_id',
        'status',
    ];
}
