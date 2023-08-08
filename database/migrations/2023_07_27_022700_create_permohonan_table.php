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
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id('id');
            $table->string('id_permohonan')->nullable();
            $table->string('nokp_pelajar');
            $table->string('program')->nullable();
            $table->string('yuran')->nullable();
            $table->string('elaun')->nullable();
            $table->string('amaun');
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
        Schema::dropIfExists('permohonan');
    }
};
