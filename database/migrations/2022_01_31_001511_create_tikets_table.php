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
            $table->string('nomorhp');
            $table->enum('permohonan',['0', '1'])->default(0);
            $table->enum('penilaian',['0', '1'])->default(0);
            $table->enum('persetujuan',['0', '1'])->default(0);
            $table->enum('lelang',['0', '1'])->default(0);
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
