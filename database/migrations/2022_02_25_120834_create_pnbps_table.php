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
        Schema::create('pnbps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tahun');
            $table->string('jenis');
            $table->string('target');
            $table->timestamps();
            $table->unique(['tahun', 'jenis']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pnbps');
    }
};
