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
        Schema::create('bk_parlimen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('negeri_id');
            $table->string('kod_parlimen');
            $table->string('parlimen');
            $table->foreign('negeri_id')
                ->references('id')->on('bk_negeri')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_parlimen');
    }
};
