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
        Schema::create('emel_kemaskini', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emel_id');
            $table->string('subjek')->nullable();
            $table->string('pendahuluan')->nullable();
            $table->longText('isi_kandungan1')->nullable();
            $table->longText('isi_kandungan2')->nullable();
            $table->string('penutup')->nullable();
            $table->string('disediakan_oleh')->nullable();
            $table->foreign('emel_id')->references('id')->on('bk_emel')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emel_kemaskini');
    }
};
