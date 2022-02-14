<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemberitahuanPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemberitahuan_penilaians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('permohonan_penilaian_id');
            $table->string('nomorSurat');
            $table->date('tanggalSurat');
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
        Schema::dropIfExists('pemberitahuan_penilaians');
    }
}
