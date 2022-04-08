<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class role extends Model
{
    use Uuids;
    use HasFactory;
    public function User(){
        return $this->belongsToMany(User::class);
    }
}
