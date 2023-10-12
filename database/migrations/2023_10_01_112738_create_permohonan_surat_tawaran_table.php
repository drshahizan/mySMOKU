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
            $table->string('no_rujukan')->nullable();
            $table->string('tajuk');
            $table->string('tujuan');
            $table->longText('kandungan1');
            $table->longText('kandungan2');
            $table->longText('kandungan3');
            $table->string('penutup1');
            $table->string('penutup2');
            $table->string('penutup3_1');
            $table->string('penutup3_2');
            $table->string('penutup3_3');
            $table->string('penutup3_4');
            $table->string('penutup4_1');
            $table->string('penutup4_2');
            $table->string('penutup4_3')->nullable();
            $table->string('penutup4_4')->nullable();
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
