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

    public function risalahLotLelang(){
        return $this->hasManyThrough(risalahLotLelang::class, risalah::class);
    }

    public function scopeSearch($data){
        if (request('key')) {
            $data->where('nomorSurat', 'like', '%'.request('key').'%' )->orwherehas('permohonanLelang', function($permohonanLelang){
                $permohonanLelang->where('nomorSurat', 'like', '%'.request('key').'%' )->orwherehas('suratPersetujuan', function($suratPersetujuan){
                    $suratPersetujuan->Search2(request('key'));
                });
            });
        }
    }

    protected $fillable = [
        'nomorSurat',
        'tanggalSurat',
        'tanggalLelang',
        'permohonan_lelang_id',
        'status',
    ];
}
