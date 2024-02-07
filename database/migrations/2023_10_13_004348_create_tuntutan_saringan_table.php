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
        Schema::create('tuntutan_saringan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tuntutan_id');
            $table->string('saringan_kep_peperiksaan')->nullable();
            $table->string('status');
            $table->string('catatan');
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
        Schema::dropIfExists('tuntutan_saringan');
    }
};
