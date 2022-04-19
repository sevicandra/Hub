<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class suratPersetujuan extends Model
{
    use Uuids;
    use HasFactory;

    public function penyampaianLaporan(){
        return $this->belongsTo(penyampaianLaporan::class);
    }
    
    public function permohonanLelang(){
        return $this->morphMany(permohonanLelang::class, 'surat_persetujuan', 'jenis');
        
        
        // return $this->hasMany(permohonanLelang::class);
    }

    public function scopeSearch($data){
        return $data->where('nomorSurat', 'like', '%'.request('key').'%')->orwherehas('penyampaianLaporan', function($penyampaianLaporan){
            $penyampaianLaporan->wherehas('pemberitahuanPenilaian', function($pemberitahuanPenilaian){
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
        });
    }

    public function scopeSearch2($data, $key){
        return $data->wherehas('penyampaianLaporan', function($penyampaianLaporan){
            $penyampaianLaporan->wherehas('pemberitahuanPenilaian', function($pemberitahuanPenilaian){
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
        });
    }

    protected $fillable = [
        'nomorSurat',
        'tanggalSurat',
        'penyampaian_laporan_id',
        'hal'
    ];
}
