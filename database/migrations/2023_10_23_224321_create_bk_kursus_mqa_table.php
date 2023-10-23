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
        Schema::create('bk_kursus_mqa', function (Blueprint $table) {
            $table->id();
            $table->string('kod_rujukan_akreditasi_penuh');
            $table->string('no_siri_sijil');
            $table->string('nama_program_bm');
            $table->string('nama_program_bi');
            $table->string('bidang_nec');
            $table->string('peringkat_kelayakan');
            $table->string('tempoh_pengajian');
            $table->string('institusi_penganugerahan');
            $table->string('kaedah_pengendalian');
            $table->string('tarikh_akreditasi');
            $table->string('kod_rujukan_program')->nullable();
            $table->date('tarikh_akreditasi_sementara')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_kursus_mqa');
    }
};
