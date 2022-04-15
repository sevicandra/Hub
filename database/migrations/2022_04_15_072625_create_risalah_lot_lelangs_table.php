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
        Schema::create('risalah_lot_lelangs', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('lot_lelang_id');
            $table->uuid('risalah_id');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->unique(['lot_lelang_id', 'risalah_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('risalah_lot_lelangs');
    }
};
