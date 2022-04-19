<?php

namespace App\Models;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiket extends Model
{
    use Uuids;
    use HasFactory;
    
    public function permohonans(){
        return $this->hasOne(permohonan::class);
    }

    public function permohonanLelang(){
        return $this->morphOne(permohonanLelang::class, 'surat_persetujuan', 'jenis');
        
    }

    public function scopeSearch2($data, $key){
        return $data->where('tiket', 'like', '%'.request('key').'%')->orwherehas('permohonanLelang', function($permohonanLelang){
            $permohonanLelang->wherehas('pemohonLelang', function($pemohonLelang){
                $pemohonLelang->where('pemohon', 'like', '%'.request('key').'%');
            });
        });
    }

    protected $fillable = [
        'tiket',
        'permohonan',
        'penilaian',
        'persetujuan',
        'lelang',
        'jenis'
    ];
}
