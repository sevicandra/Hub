<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class presentasi extends Model
{
    use Uuids;
    use HasFactory;
    protected $fillable = ['tanggal', 'judul', 'file', 'user_id'];

    public function scopeSearch($data){
        if (request('key')) {
            return $data->where('judul', 'like', '%'.request('key').'%');
        }
    }
}
