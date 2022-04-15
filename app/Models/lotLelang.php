<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lotLelang extends Model
{
    use Uuids;
    use HasFactory;

    public function permohonanLelang(){
        return $this->belongsTo(permohonanLelang::class);
    }

    public function risalah(){
        return $this->belongsToMany(risalah::class);
    }

    public function risalahLotLelang(){
        return $this->hasMany(risalahLotLelang::class);
    }

    protected $fillable =[
        'permohonan_lelang_id',
        'namaLot',
        'limit',
        'status'
    ];
}
