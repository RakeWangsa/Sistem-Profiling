<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggaranPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggaran_perusahaan', function (Blueprint $table) {
            $table->foreignId('id_catatan')->constrained('catatan');
            $table->foreignId('pelanggaran_id')->constrained('pelanggaran');            
            $table->smallInteger('perusahaan_id')->constrained('tb_r_trader', 'id_trader');
            $table->string('keterangan');
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
        Schema::dropIfExists('pelanggaran_perusahaan');
    }
}
