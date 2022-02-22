<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kinerjaOrganisasi extends Model
{
    use Uuids;
    use HasFactory;
    protected $fillable = [
        'KodeIKU',
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
}
