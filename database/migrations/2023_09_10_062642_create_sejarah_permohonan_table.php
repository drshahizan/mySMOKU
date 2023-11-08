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
        Schema::create('sejarah_permohonan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('smoku_id');
            $table->unsignedBigInteger('permohonan_id');
            $table->integer('status');
            $table->unsignedBigInteger('dilaksanakan_oleh')->nullable();
            $table->foreign('smoku_id')
              ->references('id')->on('smoku')->onDelete('cascade');
            $table->foreign('permohonan_id')
              ->references('id')->on('permohonan')->onDelete('cascade');
            $table->foreign('dilaksanakan_oleh')
              ->references('id')->on('users')->onDelete('cascade');     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sejarah_permohonan');
    }
};
