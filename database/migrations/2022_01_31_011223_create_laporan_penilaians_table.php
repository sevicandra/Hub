<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_penilaians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pemberitahuan_penilaian_id');
            $table->string('nomorLaporan');
            $table->date('tanggalLaporan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_penilaians');
    }
}
