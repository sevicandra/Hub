<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class penyampaianLaporan extends Model
{
    use Uuids;
    use HasFactory;

    public function suratPersetujuan(){
        return $this->hasOne(suratPersetujuan::class);
    }

    public function laporanPenilaians(){
        return $this->belongstoMany(laporanPenilaian::class);
    }
}
