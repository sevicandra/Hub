<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agendaLaporanPenilaian extends Model
{
    use HasFactory;
    use Uuids;
    protected $fillable=[
        'nomor',
        'tanggal',
        'pemohon',
        'kode',
        'nilaiWajar',
        'file',
        'tahun'
    ];
    public function basl(){
        return $this->belongsToMany(beritaAcaraSurveiLapanganPenilaian::class, 'basl_laporan_penilaians', 'laporan_id', 'basl_id');
    }
}
