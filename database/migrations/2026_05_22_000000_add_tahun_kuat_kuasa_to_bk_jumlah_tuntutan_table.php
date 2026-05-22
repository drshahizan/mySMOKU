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
        Schema::table('bk_jumlah_tuntutan', function (Blueprint $table) {
            $table->string('tahun_kuat_kuasa')->nullable()->after('jumlah');
        });

        DB::table('bk_jumlah_tuntutan')->updateOrInsert(
            [
                'program' => 'PPK',
                'jenis' => 'Wang Saku',
                'semester' => null,
                'tahun_kuat_kuasa' => '2026',
            ],
            [
                'jumlah' => '3100',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('bk_jumlah_tuntutan')
            ->where('program', 'PPK')
            ->where('jenis', 'Wang Saku')
            ->where('tahun_kuat_kuasa', '2026')
            ->where('jumlah', '3100')
            ->delete();

        Schema::table('bk_jumlah_tuntutan', function (Blueprint $table) {
            $table->dropColumn('tahun_kuat_kuasa');
        });
    }
};
