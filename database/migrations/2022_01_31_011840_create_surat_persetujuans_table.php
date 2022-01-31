<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratPersetujuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_persetujuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyampaianLaporan_id');
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
        Schema::dropIfExists('surat_persetujuans');
    }
}
