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
        Schema::create('maklumatTuntutan', function (Blueprint $table) {
            $table->id('id_tuntutan');
            $table->integer('id_permohonan');
            $table->string('nokp_pelajar');
            $table->string('yuran');
            $table->string('no_resit');
            $table->string('amaun');
            $table->string('baki');
            $table->string('semester');
            $table->string('sesi_akademik');
            $table->string('perakuan');
            
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
        Schema::dropIfExists('maklumatTuntutan');
    }
};
