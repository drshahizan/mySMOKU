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
        Schema::create('permohonan_surat_tawaran', function (Blueprint $table) {
            $table->id();
            $table->string('tajuk');
            $table->string('kandungan1');
            $table->string('kandungan2');
            $table->string('kandungan3');
            $table->string('penutup1');
            $table->string('penutup2');
            $table->string('penutup3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_surat_tawaran');
    }
};
