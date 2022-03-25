<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class penetapanLelang extends Model
{
    use Uuids;
    use HasFactory;
    public function permohonanLelang(){
        return $this->belongsTo(permohonanLelang::class);
    }

    public function risalah(){
        return $this->hasMany(risalah::class);
    }

    public function barangLelang(){
        return $this->hasManyThrough(barangLelang::class, risalah::class);
    }



    protected $fillable = [
        'nomorSurat',
        'tanggalSurat',
        'tanggalLelang',
        'permohonan_lelang_id',
        'status',
    ];
}
