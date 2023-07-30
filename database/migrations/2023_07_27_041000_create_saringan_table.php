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
        Schema::create('saringan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_permohonan');
            $table->integer('id_sekretariat');
            $table->boolean('suratTawaran');
            $table->string('nota_suratTawaran');
            $table->boolean('akaunBank');
            $table->string('nota_akaunBank');
            $table->boolean('kepPeperiksaan');
            $table->string('nota_kepPeperiksaan');
            $table->boolean('invoisResit');
            $table->string('nota_invoisResit');
            $table->date('tarikhSaring');
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
        Schema::dropIfExists('saringan');
    }
};
