<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class risalah extends Model
{
    use Uuids;
    use HasFactory;

    public function penetapanLelang(){
        return $this->belongsTo(penetapanLelang::class);
    }

    public function barang(){
        return $this->belongsToMany(barang::class, 'barang_lelangs', 'risalah_id', 'barang_id');
    }

    public function barangLelang(){
        return $this->hasMany(barangLelang::class);
    }
    
    protected $fillable = [
        'nomor',
        'tanggal',
        'nilaiPokok',
        'penetapan_lelang_id'
    ];
}
