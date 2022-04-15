<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tiket');
            $table->tinyInteger('permohonan')->default(0);
            $table->tinyInteger('penilaian')->default(0);
            $table->tinyInteger('persetujuan')->default(0);
            $table->tinyInteger('lelang')->default(0);
            $table->enum('jenis',['PKN', 'LLG'])->required();
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
        Schema::dropIfExists('tikets');
    }
}
