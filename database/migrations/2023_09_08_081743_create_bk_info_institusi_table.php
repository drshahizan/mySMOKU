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
        Schema::create('bk_info_institusi', function (Blueprint $table) {
            $table->id();
            $table->string('id_institusi');
            $table->string('institusi_esp')->nullable();
            $table->string('nama_institusi');
            $table->string('nama_institusi_bi')->nullable();
            $table->string('poskod')->nullable();
            $table->string('jenis_institusi')->nullable();
            $table->string('jenis_permohonan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_info_institusi');
    }
};
