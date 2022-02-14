<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class permohonanPenilaian extends Model
{
    use Uuids;
    use HasFactory;

    public function permohonan(){
        return $this->belongsTo(permohonan::class);
    }

    public function pemberitahuanPenilaian(){
        return $this->hasOne(pemberitahuanPenilaian::class);
    }
    protected $fillable = [
        'nomorSurat',
        'tanggalSurat',
        'permohonan_id',
        'hal',
    ];
}
