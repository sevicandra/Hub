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
        Schema::create('pemilihan_best_employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('bulan', ['01', '02', '03', '04', '05', '06', '07','08', '09', '10', '11', '12']);
            $table->year('tahun');
            $table->enum('status', [1, 2, 3]);
            $table->timestamps();
            $table->unique(['tahun', 'bulan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemilihan_best_employees');
    }
};
