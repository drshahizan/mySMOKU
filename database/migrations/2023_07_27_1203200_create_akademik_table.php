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
        Schema::create('maklumatAkademik', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaranpelajar');
            $table->string('nokp_pelajar');
            $table->string('peringkat_pengajian');
            $table->string('nama_kursus');
            $table->integer('id_institusi');
            $table->date('tkh_mula');
            $table->date('tkh_tamat');
            $table->string('sem_semasa');
            $table->string('tempoh_pengajian');
            $table->string('bil_bulapersem');
            $table->string('mod');
            $table->string('cgpa');
            $table->string('sumber_biaya');
            $table->string('nama_penaja');
            $table->string('status');
            $table->string('terimaHLP');
            $table->date('tkh_maklumat');
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
        Schema::dropIfExists('maklumatAkademik');
    }
};
