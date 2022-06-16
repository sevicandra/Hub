<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita_acara_survei_lapangan_penilaians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('nomor');
            $table->string('kode');
            $table->year('tahun');
            $table->integer('tujuanPenilaian');
            $table->string('objek');
            $table->string('pemilik');
            $table->date('tanggalMulaiSurvei');
            $table->date('tanggalSelesaiSurvei');
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
        Schema::dropIfExists('berita_acara_survei_lapangan_penilaians');
    }
};
