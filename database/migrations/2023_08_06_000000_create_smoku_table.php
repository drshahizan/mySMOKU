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
        Schema::create('smoku', function (Blueprint $table) {
            $table->id();
            $table->string('nokp')->unique();
            $table->string('nama');
            $table->string('kecacatan');
            $table->string('noJKM');
            $table->string('noTentera')->nullable();
            $table->string('gambar')->nullable();
            $table->date('tkh_lahir');
            $table->integer('umur');
            $table->string('bangsa');
            $table->string('pendapatan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('status_pekerjaan')->nullable();
            $table->string('jantina');
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
            $table->string('nama_waris');
            $table->string('nokp_waris');
            $table->string('pekerjaan_waris');
            $table->string('hubungan');
            $table->string('notel_waris')->nullable();
            $table->integer('verify')->nullable();
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
        Schema::dropIfExists('smoku');
    }
};
