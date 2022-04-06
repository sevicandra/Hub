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
        Schema::create('rencana_aksis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('idikator_kinerja_utama_id');           
            $table->date('tanggalMulai');
            $table->date('tanggalSelesai');
            $table->string('rencanaAksi');
            $table->enum('status', [0,1]);
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
        Schema::dropIfExists('rencana_aksis');
    }
};
