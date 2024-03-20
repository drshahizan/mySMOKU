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
        Schema::create('tuntutan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('smoku_id');
            $table->unsignedBigInteger('permohonan_id');
            $table->string('no_rujukan_tuntutan');
            $table->string('sesi');
            $table->string('semester');
            $table->string('status');
            $table->string('yuran')->nullable();
            $table->string('wang_saku')->nullable();
            $table->float('amaun_wang_saku')->nullable();
            $table->float('yuran_disokong')->nullable();
            $table->float('yuran_dibayar')->nullable();
            $table->float('wang_saku_disokong')->nullable();
            $table->float('wang_saku_dibayar')->nullable();
            $table->float('jumlah')->nullable();
            $table->float('baki')->nullable();
            $table->float('baki_disokong')->nullable();
            $table->float('baki_dibayar')->nullable();
            $table->string('catatan_dibayar')->nullable();
            $table->string('no_baucer')->nullable();
            $table->date('tarikh_baucer')->nullable();
            $table->string('perihal')->nullable();
            $table->string('no_cek')->nullable();
            $table->date('tarikh_transaksi')->nullable();
            $table->date('tarikh_hantar')->nullable();
            $table->string('status_pemohon')->nullable();
            $table->string('sesi_bayaran',)->nullable();
            $table->string('data_migrate',)->nullable();
            $table->foreign('smoku_id')
              ->references('id')->on('smoku')->onDelete('cascade');
            $table->foreign('permohonan_id')
              ->references('id')->on('permohonan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuntutan');
    }
};
