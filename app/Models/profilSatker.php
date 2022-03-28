<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class profilSatker extends Model
{
    use Uuids;
    use HasFactory;

    public function satker(){
        return $this->belongsTo(satuanKerja::class);
    }
    protected $fillable = [
        'satuan_kerja_id',
        'alamat',
        'namaKepalaSatker',
        'noTeleponKepalaSatker',
        'namaOperator',
        'noTeleponOperator',
    ];
}
