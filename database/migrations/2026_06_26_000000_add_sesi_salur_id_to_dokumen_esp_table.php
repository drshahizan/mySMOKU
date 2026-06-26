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
        Schema::table('dokumen_esp', function (Blueprint $table) {
            $table->unsignedBigInteger('sesi_salur_id')->nullable()->after('no_rujukan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen_esp', function (Blueprint $table) {
            $table->dropColumn('sesi_salur_id');
        });
    }
};
