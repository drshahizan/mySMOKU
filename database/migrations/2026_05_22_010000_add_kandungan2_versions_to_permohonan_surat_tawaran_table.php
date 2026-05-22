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
        Schema::table('permohonan_surat_tawaran', function (Blueprint $table) {
            $table->longText('kandungan2_lama')->nullable()->after('kandungan2');
            $table->longText('kandungan2_baru')->nullable()->after('kandungan2_lama');
        });

        $suratTawaranPpk = DB::table('permohonan_surat_tawaran')->where('id', 2)->first();

        if ($suratTawaranPpk) {
            DB::table('permohonan_surat_tawaran')
                ->where('id', 2)
                ->update([
                    'kandungan2_lama' => $suratTawaranPpk->kandungan2_lama
                        ?? 'Penetapan kadar bayaran adalah berjumlah RM4,260 bagi Semester 1 dan RM 3,960 bagi Semester 2 hingga Semester 4.',
                    'kandungan2_baru' => $suratTawaranPpk->kandungan2_baru
                        ?? $suratTawaranPpk->kandungan2,
                    'updated_at' => now(),
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permohonan_surat_tawaran', function (Blueprint $table) {
            $table->dropColumn(['kandungan2_lama', 'kandungan2_baru']);
        });
    }
};
