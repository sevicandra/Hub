<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class permohonanLelang extends Model
{
    use Uuids;
    use HasFactory;

    
    public function suratPersetujuan()
    {
        return $this->morphTo(__FUNCTION__, 'jenis', 'surat_persetujuan_id');
    }

    
    public function penetapanLelang(){
        return $this->hasOne(penetapanLelang::class);
    }
    
    public function barang(){
        return $this->belongsToMany(barang::class);
    }

    public function pemohonLelang(){
        return $this->hasOne(pemohonLelang::class);
    }
    
    public function lotLelang(){
        return $this->hasMany(lotLelang::class);
    }


    public function scopeSearch($data){
        if (request('key')) {
            $data->where('nomorSurat', 'like', '%'.request('key').'%' )->orwherehas('suratPersetujuan', function($suratPersetujuan){
                $suratPersetujuan->Search2(request('key'));
            });
        }
    }

    protected $fillable = [
        'nomorSurat',
        'hal',
        'tanggalSurat',
        'tanggalDiTerima',
        'surat_persetujuan_id',
        'jenis',
    ];
}
