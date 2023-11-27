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
            $table->string('tajuk')->nullable();
            $table->string('tujuan')->nullable();
            $table->longText('kandungan1')->nullable();
            $table->longText('kandungan2')->nullable();
            $table->longText('kandungan3')->nullable();
            $table->string('penutup1')->nullable();
            $table->string('penutup2')->nullable();
            $table->string('penutup3_1')->nullable();
            $table->string('penutup3_2')->nullable();
            $table->string('penutup3_3')->nullable();
            $table->string('penutup3_4')->nullable();
            $table->string('penutup4_1')->nullable();
            $table->string('penutup4_2')->nullable();
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
