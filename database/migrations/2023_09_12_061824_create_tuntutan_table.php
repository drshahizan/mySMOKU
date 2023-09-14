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
            $table->integer('no_rujukan_tuntutan');
            $table->string('jenis_yuran');
            $table->string('no_resit');
            $table->string('resit');
            $table->string('nota_resit');
            $table->string('amaun');
            $table->string('baki');
            $table->string('sesi');
            $table->string('semester');
            $table->string('status');
            $table->foreign('smoku_id')
              ->references('id')->on('smoku')->onDelete('cascade');
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
