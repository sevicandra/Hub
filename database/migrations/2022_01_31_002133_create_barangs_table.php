<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permohonan_id');
            $table->string('kodeBarang');
            $table->string('NUP');
            $table->string('merkType');
            $table->string('nomorPolisi');
            $table->string('nomorRangka');
            $table->string('nomorMesin');
            $table->string('keterangan');
            $table->string('nilaiWajar');
            $table->string('nilaiLimit');
            $table->string('status');
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
        Schema::dropIfExists('barangs');
    }
}
