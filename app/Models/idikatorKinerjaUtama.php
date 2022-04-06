<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class idikatorKinerjaUtama extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'KodeIKU',
        'user_id',
        'tahun',
        'namaIKU',
        'konsolidasi',
        'polarisasi'
    ];

    public function target(){
        return $this->morphMany(target::class, 'idikator_kinerja_utama', 'jeniskinerja');
    }

    public function capaian(){
        return $this->morphMany(capaian::class, 'idikator_kinerja_utama', 'jeniskinerja');
    }

    public function capaianlast(){
        return $this->morphOne(capaian::class, 'idikator_kinerja_utama', 'jeniskinerja')->ofMany('bulan', 'max');
    }

    public function targetlast(){
        return $this->morphOne(target::class, 'idikator_kinerja_utama', 'jeniskinerja')->ofMany('periode', 'max');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function rencanaAksi(){
        return $this->hasMany(rencanaAksi::class);
    }

}
