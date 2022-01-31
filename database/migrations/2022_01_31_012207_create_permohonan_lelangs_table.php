<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanLelangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_lelangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('suratPersetujuan_id');
            $table->string('nomorSurat');
            $table->date('tanggalSurat');
            $table->date('tanggalDiTerima');
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
        Schema::dropIfExists('permohonan_lelangs');
    }
}
