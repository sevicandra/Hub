<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class laporanPenilaian extends Model
{
    use Uuids;
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
