<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('tamat_pengajian', 'jenis_laporan')) {
            DB::statement("ALTER TABLE tamat_pengajian ADD jenis_laporan VARCHAR(20) NULL DEFAULT 'TAMAT' AFTER permohonan_id");
        }

        DB::statement('ALTER TABLE tamat_pengajian MODIFY sijil_tamat VARCHAR(255) NULL');
        DB::statement('ALTER TABLE tamat_pengajian MODIFY transkrip VARCHAR(255) NULL');
        DB::statement('ALTER TABLE tamat_pengajian MODIFY cgpa VARCHAR(255) NULL');
        DB::statement('ALTER TABLE tamat_pengajian MODIFY kelas INT NULL');
    }

    public function down(): void
    {
        if (Schema::hasColumn('tamat_pengajian', 'jenis_laporan')) {
            DB::statement('ALTER TABLE tamat_pengajian DROP COLUMN jenis_laporan');
        }
    }
};