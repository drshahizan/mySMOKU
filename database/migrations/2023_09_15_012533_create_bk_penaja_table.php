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
        Schema::create('bk_penaja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sumber_id');
            $table->string('penaja');
            $table->foreign('sumber_id')
              ->references('id')->on('bk_sumber_biaya')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_penaja');
    }
};
