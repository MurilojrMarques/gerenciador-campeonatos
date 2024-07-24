<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfrontosTable extends Migration
{
    public function up()
    {
        Schema::create('confrontos', function (Blueprint $table) {
            $table->id();
            $table->string('time_casa');
            $table->integer('placar_casa')->nullable();
            $table->string('time_visitante');
            $table->integer('placar_visitante')->nullable();
            $table->string('vencedor')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('confrontos');
    }
}