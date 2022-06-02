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
        //     $table->uuid('id')->primary();
        //     $table->uuid('kementerian_id');
        //     $table->decimal('kodeSatker', 6,0)->zerofill();
        //     $table->string('jabatanPimpinan');
        //     $table->string('namaSatker');
        //     $table->string('kodeSatkerFull');
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
