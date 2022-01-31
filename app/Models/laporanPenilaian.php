<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporanPenilaian extends Model
{
    use HasFactory;

    public function pemberitahuanPenilaian(){
        return $this->belongsTo(pemberitahuanPenilaian::class);
    }

    public function barangs(){
        return $this->belongstoMany(barang::class);
    }

    public function penyampaianLaporans(){
        return $this->belongstoMany(penyampaianLaporan::class);
    }
    
}
