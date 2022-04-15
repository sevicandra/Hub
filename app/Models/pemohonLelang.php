<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemohonLelang extends Model
{
    use Uuids;
    use HasFactory;

    public function permohonanLelang(){
        return $this->belongsTo(permohonanLelang::class);
    }


    protected $fillable = [
        'permohonan_lelang_id',
        'pemohon',
        'kontakPemohon',
        'PIC'
    ];

}
