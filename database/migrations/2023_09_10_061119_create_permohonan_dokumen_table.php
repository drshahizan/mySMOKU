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
        Schema::create('permohonan_dokumen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permohonan_id');
            $table->string('no_rujukan_permohonan');
            $table->string('id_sekretariat')->nullable();
            $table->string('suratTawaran')->nullable();
            $table->string('nota_suratTawaran')->nullable();
            $table->string('akaunBank')->nullable();
            $table->string('nota_akaunBank')->nullable();
            $table->string('kepPeperiksaan')->nullable();
            $table->string('nota_kepPeperiksaan')->nullable();
            $table->string('invoisResit')->nullable();
            $table->string('nota_invoisResit')->nullable();
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
        Schema::dropIfExists('permohonan_dokumen');
    }
};
