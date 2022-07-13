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
        Schema::create('media_surat_persetujuans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('surat_persetujuan_id');
            $table->string('file');
            $table->string('Wa_id');
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
        Schema::dropIfExists('media_surat_persetujuans');
    }
};