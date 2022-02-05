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
        return $this->hasOne(risalah::class);
    }

}
