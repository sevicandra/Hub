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
    protected $fillable = [
        'tiket',
        'nomorhp',
        'permohonan',
        'penilaian',
        'persetujuan',
        'lelang',
    ];
}
