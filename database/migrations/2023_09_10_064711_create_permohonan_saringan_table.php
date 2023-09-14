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
        Schema::create('permohonan_saringan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permohonan_id');
            $table->string('no_rujukan_saringan')->nullable();
            $table->string('catatan_profil_diri')->nullable();
            $table->string('catatan_akademik')->nullable();
            $table->string('catatan_salinan_dokumen')->nullable();
            $table->foreign('permohonan_id')
              ->references('id')->on('permohonan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_saringan');
    }
};
