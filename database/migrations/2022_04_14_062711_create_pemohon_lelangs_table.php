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
        Schema::create('pemohon_lelangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('permohonan_lelang_id');
            $table->string('pemohon');
            $table->string('PIC');
            $table->string('kontakPemohon');
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
        Schema::dropIfExists('pemohon_lelangs');
    }
};
