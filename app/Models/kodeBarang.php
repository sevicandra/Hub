<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kodeBarang extends Model
{
    use HasFactory;
    public function barang(){
        return $this->hasMany(barang::class, 'kodeBarang',);
    }
}
