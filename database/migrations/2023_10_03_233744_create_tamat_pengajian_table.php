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
        Schema::create('tamat_pengajian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('smoku_id');
            $table->unsignedBigInteger('permohonan_id');
            $table->string('sijil_tamat'); 
            $table->string('transkrip'); 
            $table->string('cgpa'); 
            $table->integer('kelas');
            $table->string('tawaran')->nullable(); 
            $table->string('institusi')->nullable(); 
            $table->integer('peringkat')->nullable();
            $table->integer('kursus')->nullable();
            $table->integer('institusi_lama')->nullable();
            $table->integer('peringkat_lama')->nullable();
            $table->integer('kursus_lama')->nullable();
            $table->string('perakuan')->nullable();
            $table->string('peringkat_baharu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamat_pengajian');
    }
};
