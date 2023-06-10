<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ppk');
            $table->smallInteger('perusahaan_id')->constrained('tb_r_trader', 'id_trader');
            $table->date('tanggal_pelanggaran');
            $table->string('tingkat_kepatuhan', 20);
            $table->integer('level_kepatuhan');
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
        Schema::dropIfExists('catatan');
    }
}
