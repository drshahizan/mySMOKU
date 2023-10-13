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
        Schema::create('tuntutan_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tuntutan_id');
            $table->string('jenis_yuran');
            $table->string('no_resit');
            $table->string('resit');
            $table->string('nota_resit');
            $table->string('amaun');
            $table->string('kep_saringan')->nullable();
            $table->foreign('tuntutan_id')
              ->references('id')->on('tuntutan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuntutan_item');
    }
};
