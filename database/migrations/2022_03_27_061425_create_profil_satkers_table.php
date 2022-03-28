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
        Schema::create('profil_satkers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('satuan_kerja_id');
            $table->string('alamat');
            $table->string('namaKepalaSatker');
            $table->string('noTeleponKepalaSatker');
            $table->string('namaOperator');
            $table->string('noTeleponOperator');
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
        Schema::dropIfExists('profil_satkers');
    }
};
