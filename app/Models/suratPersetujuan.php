<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class suratPersetujuan extends Model
{
    use Uuids;
    use HasFactory;

    public function penyampaianLaporan(){
        return $this->belongsTo(penyampaianLaporan::class);
    }
    
    public function permohonanLelang(){
        return $this->hasMany(permohonanLelang::class);
    }

    protected $fillable = [
        'nomorSurat',
        'tanggalSurat',
        'penyampaian_laporan_id',
    ];
}
