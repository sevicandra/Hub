<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    public function permohonan(){
        return $this->belongsto(permohonan::class);
    }

    public function laporanPenilaians(){
        return $this->belongstoMany(laporanPenilaian::class);
    }

}
