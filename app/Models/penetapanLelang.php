<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penetapanLelang extends Model
{
    use HasFactory;
    public function permohonanLelang(){
        return $this->belongsTo(permohonanLelang::class);
    }

    public function risalah(){
        return $this->hasOne(risalah::class);
    }

}
