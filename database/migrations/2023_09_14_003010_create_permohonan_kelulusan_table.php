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
        Schema::create('permohonan_kelulusan', function (Blueprint $table) {
            $table->id();
            $table->string('id_permohonan')->nullable();
            $table->string('no_mesyuarat')->nullable();
            $table->date('tarikh_mesyuarat')->nullable();
            $table->string('keputusan')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_kelulusan');
    }
};
