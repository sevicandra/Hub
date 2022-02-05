<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class barang extends Model
{
    use Uuids;
    use HasFactory;

    public function permohonan(){
        return $this->belongsto(permohonan::class);
    }

    public function laporanPenilaians(){
        return $this->belongstoMany(laporanPenilaian::class);
    }

}
