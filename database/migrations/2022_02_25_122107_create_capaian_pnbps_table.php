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
        Schema::create('capaian_pnbps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pnbp_id');
            $table->string('bulan');
            $table->string('capaian');
            $table->timestamps();
            $table->unique(['pnbp_id', 'bulan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capaian_pnbps');
    }
};
