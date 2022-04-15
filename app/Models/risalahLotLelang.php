<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class risalahLotLelang extends Model
{
    use Uuids;
    use HasFactory;
    protected $fillable = [
        'risalah_id',
        'lot_lelang_id',
        'status',
    ];
    public function lotLelang(){
        return $this->belongsTo(lotLelang::class);
    }

    public function risalah(){
        return $this->belongsTo(risalah::class);
    }
}
