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
        Schema::create('barang_lelangs', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('risalah_id');
            $table->uuid('barang_id');
            $table->integer('status');
            $table->timestamps();
            $table->unique(['barang_id', 'risalah_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_lelangs');
    }
};
