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
        Schema::table('tuntutan', function (Blueprint $table) {
            $table->string('esp_sent_status')->nullable()->after('data_migrate');
            $table->timestamp('esp_sent_at')->nullable()->after('esp_sent_status');
            $table->json('esp_sent_response')->nullable()->after('esp_sent_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tuntutan', function (Blueprint $table) {
            $table->dropColumn(['esp_sent_status', 'esp_sent_at', 'esp_sent_response']);
        });
    }
};
