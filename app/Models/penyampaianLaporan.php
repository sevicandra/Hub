<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penyampaianLaporan extends Model
{
    use HasFactory;

    public function suratPersetujuan(){
        return $this->hasOne(suratPersetujuan::class);
    }

    public function laporanPenilaians(){
        return $this->belongstoMany(laporanPenilaian::class);
    }
}
