<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class target extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable=[
        'idikator_kinerja_utama_id',
        'periode',
        'target',
        'raw',
    ];
}
