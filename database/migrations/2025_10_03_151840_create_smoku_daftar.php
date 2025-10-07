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
        Schema::create('smoku_daftar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('smoku_id');
            $table->unsignedBigInteger('pendaftar_id');
            $table->string('status')->nullable();
            $table->foreign('smoku_id')
              ->references('id')->on('smoku')->onDelete('cascade');
            $table->foreign('pendaftar_id')
              ->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smoku_daftar');
    }
};
