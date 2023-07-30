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
        Schema::create('pelajar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelajar');
            $table->string('nokp_pelajar')->unique();
            $table->date('tkh_lahir');
            $table->integer('umur');
            $table->string('noJKM');
            $table->string('bangsa');
            $table->string('jantina');
            $table->string('kecacatan');
            $table->string('alamat1');
            $table->string('alamat2');
            $table->string('alamat3');
            $table->string('alamat_poskod');
            $table->string('alamat_negeri');
            $table->string('dun');
            $table->string('parlimen');
            $table->string('alamat_surat1');
            $table->string('alamat_surat2');
            $table->string('alamat_surat3');
            $table->string('alamat_surat_poskod');
            $table->string('alamat_surat_bandar');
            $table->string('alamat_surat_negeri');
            $table->string('no_telR');
            $table->string('no_tel');
            $table->string('no_akaunbank');
            $table->string('emel');
            $table->string('id_penyelaras');
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
        Schema::dropIfExists('pelajar');
    }
};
