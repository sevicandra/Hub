<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('permohonan_penilaian_user', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('permohonan_penilaian_id');
            $table->timestamps();
            // $table->primary(['permohonan_penilaian_id', 'user_id']);
        });
        Schema::create('barang_permohonan_lelang', function (Blueprint $table) {
            $table->uuid('barang_id');
            $table->uuid('permohonan_lelang_id');
            $table->timestamps();
            $table->primary(['barang_id', 'permohonan_lelang_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permohonan_penilaian_user');
        Schema::dropIfExists('barang_permohonan_lelang');
        
    }
}
