<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class idikatorKinerjaUtama extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'KodeIKU',
        'user_id',
        'tahun',
        'namaIKU',
        'konsolidasi',
        'polarisasi'
    ];

    public function target(){
        return $this->hasMany(target::class);
    }

    public function capaian(){
        return $this->hasMany(capaian::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
