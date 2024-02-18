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
        Schema::create('bk_jumlah_peruntukan', function (Blueprint $table) {
            $table->id();
            $table->date('tarikh_mula');
            $table->date('tarikh_tamat');
            $table->float('jumlahBKOKU');
            $table->float('jumlahPPK');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_jumlah_peruntukan');
    }
};
