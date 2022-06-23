<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mediaSuratPersetujuan extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable =[
        'surat_persetujuan_id',
        'file',
        'Wa_id',
    ];


}
