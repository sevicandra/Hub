<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('barang_laporan_penilaian', function (Blueprint $table) {
            $table->uuid('barang_id');
            $table->uuid('laporan_penilaian_id');
            $table->primary(['barang_id', 'laporan_penilaian_id']); 
        });

        Schema::create('laporan_penilaian_penyampaian_laporan', function (Blueprint $table) {
            $table->uuid('laporan_penilaian_id');
            $table->uuid('penyampaian_laporan_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('barang_laporan_penilaian');
        Schema::dropIfExists('laporan_penilaian_penyampaian_laporan');
    }
}
