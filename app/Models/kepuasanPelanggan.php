<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kepuasanPelanggan extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'layanan',
        'tangibles',
        'reliability',
        'responsiveness',
        'assurance',
        'empathy',
    ];
}
