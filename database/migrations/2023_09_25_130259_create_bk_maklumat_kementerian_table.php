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
        Schema::create('bk_maklumat_kementerian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kementerian_bm');
            $table->string('nama_kementerian_bi')->nullable();
            $table->string('nama_bahagian_bm');
            $table->string('nama_bahagian_bi')->nullable();
            $table->string('alamat1');
            $table->string('alamat2');
            $table->string('poskod');
            $table->string('negeri');
            $table->string('negara');
            $table->string('tel');
            $table->string('hotline');
            $table->string('faks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_maklumat_kementerian');
    }
};
