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
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('smoku_id');
            $table->string('no_rujukan_permohonan');
            $table->string('program');
            $table->string('yuran')->nullable();
            $table->string('amaun_yuran')->nullable();
            $table->string('wang_saku')->nullable();
            $table->string('amaun_wang_saku')->nullable();
            $table->string('yuran_disokong')->nullable();
            $table->string('yuran_dibayar')->nullable();
            $table->string('wang_saku_disokong')->nullable();
            $table->string('wang_saku_dibayar')->nullable();
            $table->string('baki')->nullable();
            $table->string('baki_disokong')->nullable();
            $table->string('baki_dibayar')->nullable();
            $table->string('catatan_disokong')->nullable();
            $table->string('catatan_dibayar')->nullable();
            $table->string('no_baucer')->nullable();
            $table->date('tarikh_baucer')->nullable();
            $table->string('perihal')->nullable();
            $table->string('no_cek')->nullable();
            $table->date('tarikh_transaksi')->nullable();
            $table->string('perakuan')->nullable();
            $table->date('tarikh_hantar')->nullable();
            $table->integer('status')->nullable();
            $table->string('status_pemohon')->nullable();
            $table->string('sesi_bayaran',)->nullable();
            $table->string('data_migrate',)->nullable();
            $table->foreign('smoku_id')
              ->references('id')->on('smoku')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan');
    }
};
