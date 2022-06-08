<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekapitulasiBestEmployee extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'nominasi_best_employee_id',
        'user_id',
        'produktifitasKerja',
        'kedisiplinan',
        'sikapKerja',
    ];

    public function user(){
        return $this->belongsTo(user::class, "user_id", "id");
    }
}
