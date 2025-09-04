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
        Schema::create('bk_sesi_salur', function (Blueprint $table) {
            $table->id();
            $table->string('sesi');
            $table->unsignedBigInteger('dilaksanakan_oleh');
            $table->foreign('dilaksanakan_oleh')
              ->references('id')->on('users')->onDelete('cascade');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_sesi_salur');
    }
};
