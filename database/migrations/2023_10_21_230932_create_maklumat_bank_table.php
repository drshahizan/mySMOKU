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
        Schema::create('maklumat_bank', function (Blueprint $table) {
            $table->id();
            $table->string('institusi_id');
            $table->string('bank_id');
            $table->string('nama_akaun');
            $table->string('no_akaun');
            $table->string('penyata_bank');
            // $table->foreign('institusi_id')
            //   ->references('id_institusi')->on('bk_info_institusi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maklumat_bank');
    }
};
