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
        Schema::create('dokumen_esp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('institusi_id');
            $table->string('no_rujukan');
            $table->string('dokumen1');
            $table->string('dokumen1a');
            $table->string('dokumen2');
            $table->string('dokumen2a');
            $table->string('dokumen3');
            $table->string('dokumen4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_esp');
    }
};
