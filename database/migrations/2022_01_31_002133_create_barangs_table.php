<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('permohonan_id');
            $table->uuid('laporan_penilaian_id')->nullable();
            $table->string('kodeBarang');
            $table->string('NUP');
            $table->string('merkType');
            $table->string('nomorPolisi')->nullable();
            $table->string('nomorRangka')->nullable();
            $table->string('nomorMesin')->nullable();
            $table->string('tahunPerolehan');
            $table->string('nilaiPerolehan');
            $table->string('keterangan')->nullable();
            $table->string('nilaiWajar')->nullable();
            $table->string('nilaiLimit')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('barangs');
    }
}
