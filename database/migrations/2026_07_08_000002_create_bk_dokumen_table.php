<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bk_dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('kod_dokumen')->unique();
            $table->string('nama_dokumen');
            $table->string('input_name');
            $table->string('jenis_dokumen')->nullable();
            $table->string('contoh_path')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedInteger('susunan')->default(0);
            $table->timestamps();
        });

        DB::table('bk_dokumen')->insert([
            [
                'kod_dokumen' => '1',
                'nama_dokumen' => 'Salinan Penyata Bank',
                'input_name' => 'akaunBank',
                'jenis_dokumen' => 'akaun_bank',
                'contoh_path' => '/assets/contoh/penyata_bank.pdf',
                'status' => true,
                'susunan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kod_dokumen' => '2',
                'nama_dokumen' => 'Salinan Surat Tawaran Pengajian',
                'input_name' => 'suratTawaran',
                'jenis_dokumen' => 'surat_tawaran',
                'contoh_path' => '/assets/contoh/tawaran.pdf',
                'status' => true,
                'susunan' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kod_dokumen' => '3',
                'nama_dokumen' => 'Salinan Resit/Invois',
                'input_name' => 'invoisResit',
                'jenis_dokumen' => 'resit_invois',
                'contoh_path' => '/assets/contoh/invois.pdf',
                'status' => false,
                'susunan' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kod_dokumen' => '5',
                'nama_dokumen' => 'Akuan Pendapatan',
                'input_name' => 'akuanPendapatan',
                'jenis_dokumen' => 'akuan_pendapatan',
                'contoh_path' => null,
                'status' => true,
                'susunan' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bk_dokumen');
    }
};
