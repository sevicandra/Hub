<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permohonanPenilaian extends Model
{
    use HasFactory;

    public function permohonan(){
        return $this->belongsTo(permohonan::class);
    }

    public function pemberitahuanPenilaian(){
        return $this->hasOne(pemberitahuanPenilaian::class);
    }
}
