<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_waris');
            $table->string('nokp_waris');
            
            $table->string('alamat1');
            $table->string('alamat2')->nullable();
            $table->string('alamat3')->nullable();
            $table->string('alamat_poskod');
            $table->string('alamat_bandar');
            $table->string('alamat_negeri');
            
            $table->string('alamat_surat1')->nullable();
            $table->string('alamat_surat2')->nullable();
            $table->string('alamat_surat3')->nullable();
            $table->string('alamat_surat_poskod')->nullable();
            $table->string('alamat_surat_bandar')->nullable();
            $table->string('alamat_surat_negeri')->nullable();
            $table->string('no_telR');
            $table->string('no_tel');
            $table->string('nokp_pelajar');
            $table->string('hubungan');
            $table->string('pendapatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waris');
    }
};
