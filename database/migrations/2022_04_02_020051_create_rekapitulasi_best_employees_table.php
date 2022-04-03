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
        Schema::create('rekapitulasi_best_employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('nominasi_best_employee_id');
            $table->uuid('user_id');
            $table->enum('produktifitasKerja',[1,2,3,4,5,6,7,8,9,10]);
            $table->enum('kedisiplinan',[1,2,3,4,5,6,7,8,9,10]);
            $table->enum('sikapKerja',[1,2,3,4,5,6,7,8,9,10]);
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
        Schema::dropIfExists('rekapitulasi_best_employees');
    }
};
