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
        Schema::create('lanjut_pengajian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('smoku_id');
            $table->unsignedBigInteger('permohonan_id');
            $table->string('surat_lanjut'); 
            $table->string('jadual'); 
            $table->string('dokumen_sokongan'); 
            $table->string('perakuan')->nullable();
            $table->foreign('smoku_id')
              ->references('id')->on('smoku')->onDelete('cascade');
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
        Schema::dropIfExists('lanjut_pengajian');
    }
};
