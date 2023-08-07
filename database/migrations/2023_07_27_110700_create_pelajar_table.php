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
            $table->string('noTentera')->nullable();
            $table->string('bangsa');
            $table->string('pendapatan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('status_pekerjaan')->nullable();
            $table->string('jantina');
            $table->string('kecacatan');
            $table->string('alamat1');
            $table->string('alamat2')->nullable();
            $table->string('alamat3')->nullable();
            $table->string('alamat_poskod');
            $table->string('alamat_bandar');
            $table->string('alamat_negeri');
            $table->string('alamat_surat1')->nullable();
            $table->string('alamat_surat2')->nullable();
            $table->string('alamat_surat3')->nullable();
            $table->string('alamat_surat_poskod')->nullable();
            $table->string('alamat_surat_bandar')->nullable();
            $table->string('alamat_surat_negeri')->nullable();
            $table->string('dun')->nullable();
            $table->string('parlimen')->nullable();
            $table->string('no_telR')->nullable();
            $table->string('no_tel')->nullable();
            $table->string('no_akaunbank');
            $table->string('emel');
            $table->string('id_penyelaras')->nullable();
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
