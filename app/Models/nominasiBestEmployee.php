<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class nominasiBestEmployee extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'pemilihan_best_employee_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function hasilPemilihan(){
        return $this->hasMany(rekapitulasiBestEmployee::class);
    }

    public function pemilihan(){
        return $this->belongsTo(pemilihanBestEmployee::class, 'pemilihan_best_employee_id', 'id');
    }
}
