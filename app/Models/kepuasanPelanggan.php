<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kepuasanPelanggan extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'layanan',
        'tangibles',
        'reliability',
        'responsiveness',
        'assurance',
        'empathy',
    ];

    public function scopeFilter($data)
    {
        if (request('start') && request('end')) {
            if (request('start')) {
                return $data->where('created_at', '>=', date_create(request('start')))->where('created_at', '<=', date('Y-m-d', strtotime(request('end'). ' + 1 days')));
            }else{
                return $data->where('created_at', '>=', date_create(request('start')))->where('created_at', '<=', date_create(request('end')));
            }
        }
    }
}
