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

    protected $fillable = [
        'tiket',
        'permohonan',
        'penilaian',
        'persetujuan',
        'lelang',
        'jenis'
    ];
}
