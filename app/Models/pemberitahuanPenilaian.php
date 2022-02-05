<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pemberitahuanPenilaian extends Model
{
    use Uuids;
    use HasFactory;

    public function permohonanPenilaian(){
        return $this->belongsTo(permohonanPenilaian::class);
    }

    public function laporanPenilaian(){
        return $this->hasMany(laporanPenilaian::class);
    }
}
