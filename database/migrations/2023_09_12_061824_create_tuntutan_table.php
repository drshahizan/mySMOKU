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
        Schema::create('tuntutan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('smoku_id');
            $table->unsignedBigInteger('permohonan_id');
            $table->string('no_rujukan_tuntutan');
            $table->string('sesi');
            $table->string('semester');
            $table->string('status');
            $table->string('wang_saku')->nullable();
            $table->string('amaun_wang_saku')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('baki')->nullable();
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
        Schema::dropIfExists('tuntutan');
    }
};
