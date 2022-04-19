<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class permohonanPenilaian extends Model
{
    use Uuids;
    use HasFactory;

    public function permohonan(){
        return $this->belongsTo(permohonan::class);
    }

    public function pemberitahuanPenilaian(){
        return $this->hasOne(pemberitahuanPenilaian::class);
    }
    protected $fillable = [
        'nomorSurat',
        'tanggalSurat',
        'permohonan_id',
        'hal',
    ];
    
    public function users(){
        return $this->belongsToMany(user::class);
    }

    public function scopeSearch($data){
        if (request('key')) {
            return $data->where('nomorSurat', 'like', '%'.request('key').'%')->orwherehas('permohonan', function($val){
                $val->where('pemohon', 'like', '%'.request('key').'%')->orwherehas('satuanKerja', function($val){
                    $val->where('namaSatker', 'like', '%'.request('key').'%');
                })->orwherehas('tiket', function($val){
                    $val->where('tiket', 'like', '%'.request('key').'%');
                });
            });
        }
    }
}