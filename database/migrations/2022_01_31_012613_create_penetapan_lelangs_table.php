<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenetapanLelangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penetapan_lelangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('permohonan_lelang_id');
            $table->string('nomorSurat');
            $table->date('tanggalSurat');
            $table->date('tanggalLelang');
            $table->enum('status', ['0', '1'])->default(0);
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
        Schema::dropIfExists('penetapan_lelangs');
    }
}
