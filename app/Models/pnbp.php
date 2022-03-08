<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pnbp extends Model
{
    use Uuids;
    use HasFactory;

    public function capaian(){
        return $this->hasMany(capaianPnbp::class);
    }

    protected $fillable = [
        'target',
        'tahun',
        'jenis',
    ];
}
