<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKementeriansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('kementerians', function (Blueprint $table) {
        //     $table->uuid('id')->primary();
        //     $table->decimal('kodeKementerian', 3,0)->zero();
        //     $table->string('namaKementerian');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('kementerians');
    }
}
