<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSatuanKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('satuan_kerjas', function (Blueprint $table) {
        //     $table->char('id', 6)->primary;
        //     $table->char('kementerian_id', 3);
        //     $table->string('namaSatker');
        //     $table->string('kodeSatker');
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
        // Schema::dropIfExists('satuan_kerjas');
    }
}
