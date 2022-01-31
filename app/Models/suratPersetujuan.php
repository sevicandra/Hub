<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suratPersetujuan extends Model
{
    use HasFactory;

    public function penyampaianLaporan(){
        return $this->belongsTo(penyampaianLaporan::class);
    }
    
    public function permohonanLelang(){
        return $this->hasMany(permohonanLelang::class);
    }

}
