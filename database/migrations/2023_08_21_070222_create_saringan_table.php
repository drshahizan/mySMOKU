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
        Schema::create('saringan', function (Blueprint $table) {
            $table->id();
            $table->string('id_permohonan')->nullable();
            $table->string('catatan_profilDiri')->nullable();
            $table->string('catatan_akademik')->nullable();
            $table->string('catatan_salinanDokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saringan');
    }
};
