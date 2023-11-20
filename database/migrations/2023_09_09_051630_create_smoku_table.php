<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('smoku', function (Blueprint $table) {
            $table->id();
            $table->string('no_kp')->unique();
            $table->string('no_id_tentera')->nullable();
            $table->string('nama');
            $table->string('no_daftar_oku');
            $table->string('kategori');
            $table->string('jantina');
            $table->date('tarikh_lahir');
            $table->integer('umur');
            $table->string('keturunan')->nullable();
            $table->string('tel_rumah')->nullable();
            $table->string('tel_bimbit')->nullable();
            $table->string('email')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('pendapatan')->nullable();
            $table->string('status_pekerjaan')->nullable();
            $table->string('alamat_tetap');
            $table->string('alamat_surat_menyurat')->nullable();
            $table->string('parlimen')->nullable();
            $table->string('dun')->nullable();
            $table->string('nama_waris')->nullable();
            $table->string('tel_bimbit_waris')->nullable();
            $table->string('hubungan_waris')->nullable();
            $table->string('pekerjaan_waris')->nullable();
            $table->string('pendapatan_waris')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smoku');
    }
};
