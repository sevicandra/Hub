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
        Schema::create('basl_laporan_penilaians', function (Blueprint $table) {
            $table->uuid('basl_id')->unique();
            $table->uuid('laporan_id');
            $table->timestamps();
            $table->primary(['basl_id', 'laporan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basl_laporan_penilaians');
    }
};
