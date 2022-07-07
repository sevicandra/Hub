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
        Schema::create('status_penggunaans', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('nomor');
            $table->enum('kodeSurat', ['/KM.6/WKN.16/KNL.04/', '/KM.6/KNL.1604/']);
            $table->date('tanggal');
            $table->string('kodeSatker');
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
        Schema::dropIfExists('status_penggunaans');
    }
};
