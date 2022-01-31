<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class risalah extends Model
{
    use HasFactory;

    public function penetapanLelang(){
        return $this->belongsTo(penetapanLelang::class);
    }
}
