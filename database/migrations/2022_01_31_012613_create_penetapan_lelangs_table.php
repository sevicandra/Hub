<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenetapanLelangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penetapan_lelangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('permohonanLelang');
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
        Schema::dropIfExists('penetapan_lelangs');
    }
}
