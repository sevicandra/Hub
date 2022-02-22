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
        Schema::create('kinerja_organisasis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tahun');
            $table->string('kodeIKU');
            $table->string('namaIKU');
            $table->string('konsolidasi');
            $table->string('polarisasi');
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
        Schema::dropIfExists('kinerja_organisasis');
    }
};
