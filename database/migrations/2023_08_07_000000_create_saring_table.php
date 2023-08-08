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
        Schema::create('saring', function (Blueprint $table) {
            $table->id();
            $table->string('id_permohonan');
            $table->string('id_sekretariat')->nullable();
            $table->string('nokp');
            $table->string('suratTawaran')->nullable();
            $table->string('nota_suratTawaran')->nullable();
            $table->string('akaunBank')->nullable();
            $table->string('nota_akaunBank')->nullable();
            $table->string('kepPeperiksaan')->nullable();
            $table->string('nota_kepPeperiksaan')->nullable();
            $table->string('invoisResit')->nullable();
            $table->string('nota_invoisResit')->nullable();
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
        Schema::dropIfExists('saring');
    }
};
