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
        
        Schema::create('permohonan_penilaian_user', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('permohonan_penilaian_id');
            $table->timestamps();
            // $table->primary(['user_id', 'permohonan_penilaian_id']);
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
        Schema::dropIfExists('permohonan_penilaian_user');
    }
}
