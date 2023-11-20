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
        Schema::create('bk_dun', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parlimen_id');
            $table->string('kod_dun');
            $table->string('dun');
            $table->foreign('parlimen_id')
                ->references('id')->on('bk_parlimen')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_dun');
    }
};
