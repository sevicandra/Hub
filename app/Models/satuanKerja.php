<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satuanKerja extends Model
{
    use HasFactory;
    public function permohonan(){
        return $this->hasMany(permohonan::class, 'pemohon',);
    }
}
