<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRisalahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risalahs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('penetapan_lelang_id');
            $table->string('nomor');
            $table->date('tanggal');
            $table->string('nilaiPokok');
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
        Schema::dropIfExists('risalahs');
    }
}
