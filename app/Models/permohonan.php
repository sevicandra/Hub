<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permohonan extends Model
{
    use HasFactory;

    public function tiket(){
        return $this->belongsTo(tiket::class);
    }

    public function barang(){
        return $this->hasMany(barang::class);
    }

    public function permohonanPenilaian(){
        return $this->hasOne(permohonanPenilaian::class);
    }
    protected $fillable = [
        'nomorSurat',
        'tiket_id',
        'pemohon',
        'tanggalSurat',
        'tanggalDiTerima',
    ];
}
