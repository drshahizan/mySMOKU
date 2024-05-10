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
        Schema::create('permohonan_peperiksaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permohonan_id');
            $table->string('sesi');
            $table->integer('semester');
            $table->string('cgpa');
            $table->string('pengesahan_rendah');
            $table->string('kepPeperiksaan');
            $table->string('nota_kepPeperiksaan')->nullable();
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
        Schema::dropIfExists('permohonan_peperiksaan');
    }
};
