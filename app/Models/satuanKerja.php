<?php

namespace App\Models;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class satuanKerja extends Model
{
    use Uuids;
    use HasFactory;
    public function permohonan(){
        return $this->hasMany(permohonan::class, 'pemohon',);
    }

    public function kementerian(){
        return $this->belongsTo(kementerian::class);
    }
    public function profil(){
        return $this->hasOne(profilSatker::class);
    }

    public function scopeSearch($data){
        if (request('key')) {
            return $data->where('kodeSatker', 'like', '%'.request('key').'%')->orwhere('namaSatker', 'like', '%'.request('key').'%')->orwherehas('kementerian', function($val){
                $val->where('namaKementerian', 'like', '%'.request('key').'%');
            })->orderBy('kodeSatkerFull');
        }
    }

    protected $fillable = [
        'kementerian_id',
        'namaSatker',
        'kodeSatker',
        'kodeSatkerFull',
    ];
}
