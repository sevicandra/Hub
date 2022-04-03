<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pemilihanBestEmployee extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'bulan',
        'tahun',
        'status',
    ];
    public function nominasi(){
        return $this->belongsToMany(User::class, 'nominasi_best_employees', 'pemilihan_best_employee_id', 'user_id');
    }
    public function listnominasi(){
        return $this->hasMany(nominasiBestEmployee::class);
    }
    public function hasilPemilihan(){
        return $this->hasManyThrough(rekapitulasiBestEmployee::class, nominasiBestEmployee::class);
    }
}
