<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class barangLelang extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'risalah_id',
        'barang_id',
        'status',
    ];
    
    public function barang(){
        return $this->belongsTo(barang::class);
    }

    public function risalah(){
        return $this->belongsTo(risalah::class);
    }
}
