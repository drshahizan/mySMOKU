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
        Schema::create('smoku_akademik', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('smoku_id');
            $table->string('no_pendaftaran_pelajar')->nullable();
            $table->string('peringkat_pengajian')->nullable();
            $table->string('nama_kursus')->nullable();
            $table->integer('id_institusi')->nullable();
            $table->string('sesi')->nullable();
            $table->date('tarikh_mula')->nullable();
            $table->date('tarikh_tamat')->nullable();
            $table->integer('emel_tamat')->nullable();
            $table->string('sem_semasa')->nullable();
            $table->string('tempoh_pengajian')->nullable();
            $table->string('bil_bulan_per_sem')->nullable();
            $table->string('mod')->nullable();
            $table->string('cgpa')->nullable();
            $table->integer('sumber_biaya')->nullable();
            $table->string('sumber_lain')->nullable();
            $table->integer('nama_penaja')->nullable();
            $table->string('penaja_lain')->nullable();
            $table->string('status')->nullable();
            $table->foreign('smoku_id')
              ->references('id')->on('smoku')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smoku_akademik');
    }
};
