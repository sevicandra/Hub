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

    public function kodeBarangs(){
        return $this->belongsto(kodeBarang::class, 'kodeBarang', 'id');
    }

    public function laporanPenilaian(){
        return $this->belongsto(laporanPenilaian::class);
    }

    public function permohonanLelang(){
        return $this->belongsToMany(permohonanLelang::class);
    }

    public function risalah(){
        return $this->belongsToMany(risalah::class, 'barang_lelang', 'barang_id', 'risalah_id');
    }

    public function barangLelang(){
        return $this->hasMany(barangLelang::class);
    }

    protected $fillable = [
        'permohonan_id',
        'laporan_penilaian_id',
        'kodeBarang',
        'NUP',
        'merkType',
        'nomorPolisi',
        'nomorRangka',
        'nomorMesin',
        'tahunPerolehan',
        'nilaiPerolehan',
        'keterangan',
        'nilaiWajar',
        'nilaiLimit',
        'status',
    ];
}
