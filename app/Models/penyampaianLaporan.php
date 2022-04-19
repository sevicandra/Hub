<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class penyampaianLaporan extends Model
{
    use Uuids;
    use HasFactory;

    public function suratPersetujuan(){
        return $this->hasOne(suratPersetujuan::class);
    }

    public function pemberitahuanPenilaian(){
        return $this->belongsTo(pemberitahuanPenilaian::class);
    }

    public function scopeSearch($data){
        if (request('key')) {
            return $data->where('nomorSurat', 'like', '%'.request('key').'%')->orwherehas('pemberitahuanPenilaian', function($pemberitahuanPenilaian){
                    $pemberitahuanPenilaian->wherehas('permohonanPenilaian', function($permohonanPenilaian){
                        $permohonanPenilaian->wherehas('permohonan', function($permohonan){
                            $permohonan->where('pemohon', 'like', '%'.request('key').'%')->orwherehas('tiket', function($tiket){
                                $tiket->where('tiket', 'like', '%'.request('key').'%');
                            })->orwherehas('satuanKerja', function($satuanKerja){
                                $satuanKerja->where('namaSatker', 'like', '%'.request('key').'%');
                            });
                        });
                    });
                });
            ;
        }
    }

    protected $fillable = [
        'nomorSurat',
        'tanggalSurat',
        'pemberitahuan_penilaian_id'
    ];


}
