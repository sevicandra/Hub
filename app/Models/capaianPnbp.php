<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class capaianPnbp extends Model
{
    use Uuids;
    use HasFactory;

    public function target(){
        return $this->belongsTo(pnbp::class, 'pnbp_id', 'id');
    }

    protected $fillable = [
        'pnbp_id',
        'bulan',
        'capaian',
    ];
}
