<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class risalah extends Model
{
    use Uuids;
    use HasFactory;

    public function penetapanLelang(){
        return $this->belongsTo(penetapanLelang::class);
    }
}
