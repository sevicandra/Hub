<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permohonanLelang extends Model
{
    use HasFactory;

    
    public function suratPersetujuan()
    {
        return $this->belongsTo(suratPersetujuan::class);
    }

    public function penetapanLelang(){
        return $this->hasOne(penetapanLelang::class);
    }
    
}
