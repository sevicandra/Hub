<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class permohonan extends Model
{
    use Uuids;
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

    public function satuanKerja(){
        return $this->belongsTo(satuanKerja::class, 'pemohon', 'id');
    }

    protected $fillable = [
        'nomorSurat',
        'tiket_id',
        'pemohon',
        'tanggalSurat',
        'tanggalDiTerima',
        'nomorhp'
    ];
}
