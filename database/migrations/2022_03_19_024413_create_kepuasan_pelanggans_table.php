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
        Schema::create('kepuasan_pelanggans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('layanan');
            $table->tinyInteger('tangibles');
            $table->tinyInteger('reliability');
            $table->tinyInteger('responsiveness');
            $table->tinyInteger('assurance');
            $table->tinyInteger('empathy');
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
        Schema::dropIfExists('kepuasan_pelanggans');
    }
};
