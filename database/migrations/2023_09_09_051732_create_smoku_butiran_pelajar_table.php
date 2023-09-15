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
        Schema::create('smoku_butiran_pelajar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('smoku_id');
            $table->string('alamat_tetap_poskod')->nullable();
            $table->string('alamat_tetap_bandar')->nullable();
            $table->string('alamat_tetap_negeri')->nullable();
            $table->string('alamat_surat');
            $table->string('alamat_surat_poskod');
            $table->string('alamat_surat_bandar');
            $table->string('alamat_surat_negeri');
            $table->string('no_akaun_bank');
            $table->string('emel');
            $table->string('tel_bimbit');
            $table->string('tel_rumah')->nullable();
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
        Schema::dropIfExists('smoku_butiran_pelajar');
    }
};

