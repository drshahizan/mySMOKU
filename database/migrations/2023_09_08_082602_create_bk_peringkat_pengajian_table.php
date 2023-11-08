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
        Schema::create('bk_peringkat_pengajian', function (Blueprint $table) {
            $table->id();
            $table->string('kod_peringkat');
            $table->string('kod_esp');
            $table->string('peringkat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_peringkat_pengajian');
    }
};
