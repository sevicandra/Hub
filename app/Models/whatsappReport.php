<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class whatsappReport extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        'parent_id',
        'report',
        'parent_type'
    ];

    public function reported(){
        return $this->morphTo(__FUNCTION__, 'parent_type', 'parent_id');
    }
}
