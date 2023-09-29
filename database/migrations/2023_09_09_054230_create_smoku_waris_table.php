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
        Schema::create('smoku_waris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('smoku_id');
            $table->string('nama_waris')->nullable();
            $table->string('no_kp_waris')->nullable();
            $table->string('no_pasport_waris')->nullable();
            $table->string('alamat_waris')->nullable();
            $table->string('alamat_negeri_waris')->nullable();
            $table->string('alamat_bandar_waris')->nullable();
            $table->string('alamat_poskod_waris')->nullable();
            $table->string('tel_bimbit_waris')->nullable();
            $table->string('hubungan_waris')->nullable();
            $table->string('hubungan_lain_waris')->nullable();
            $table->string('pekerjaan_waris')->nullable();
            $table->string('pendapatan_waris')->nullable();
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
        Schema::dropIfExists('smoku_waris');
    }
};
