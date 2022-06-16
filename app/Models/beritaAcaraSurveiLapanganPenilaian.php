<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beritaAcaraSurveiLapanganPenilaian extends Model
{
    use HasFactory;
    use Uuids;
    protected $fillable=[
        'nomor',
        'kode',
        'tujuanPenilaian',
        'objek',
        'pemilik',
        'tanggalMulaiSurvei',
        'tanggalSelesaiSurvei',
        'tahun'
    ];
    public function laporan(){
        return $this->belongsToMany(agendaLaporanPenilaian::class, 'basl_laporan_penilaians', 'basl_id', 'laporan_id');
    }

    public function user(){
        return $this->belongsToMany(User::class, 'basl_users', 'basl_id', 'user_id');
    }
}
