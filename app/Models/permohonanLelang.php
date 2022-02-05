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
        return $this->belongsTo(suratPersetujuan::class);
    }

    public function penetapanLelang(){
        return $this->hasOne(penetapanLelang::class);
    }
    
}
