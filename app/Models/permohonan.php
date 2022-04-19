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
        return $this->belongsTo(satuanKerja::class, 'pemohon', 'kodeSatker');
    }

    public function scopeSearch($data){
        if (request('key')) {
            return $data->where('nomorSurat', 'like', '%'.request('key').'%')->orwhere('pemohon', 'like', '%'.request('key').'%')->orwherehas('satuanKerja', function($val){
                $val->where('namaSatker', 'like', '%'.request('key').'%');
            })->orwherehas('tiket', function($val){
                $val->where('tiket', 'like', '%'.request('key').'%');
            });
        }
    }

    protected $fillable = [
        'nomorSurat',
        'hal',
        'tiket_id',
        'pemohon',
        'tanggalSurat',
        'tanggalDiTerima',
        'nomorhp'
    ];
}
