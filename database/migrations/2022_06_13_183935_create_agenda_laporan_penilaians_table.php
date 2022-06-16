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
        Schema::create('agenda_laporan_penilaians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('nomor');
            $table->date('tanggal');
            $table->string('kode');
            $table->year('tahun');
            $table->string('pemohon');
            $table->unsignedDecimal('nilaiWajar', $precision = 20, $scale = 2);
            $table->string('file')->nullable();
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
        Schema::dropIfExists('agenda_laporan_penilaians');
    }
};
