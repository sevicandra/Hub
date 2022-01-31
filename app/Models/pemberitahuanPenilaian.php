<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemberitahuanPenilaian extends Model
{
    use HasFactory;

    public function permohonanPenilaian(){
        return $this->belongsTo(permohonanPenilaian::class);
    }

    public function laporanPenilaian(){
        return $this->hasMany(laporanPenilaian::class);
    }
}
