<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateConfrontosTable extends Migration
{
    public function up()
    {
        Schema::table('confrontos', function (Blueprint $table) {
            $table->unsignedBigInteger('campeonato_id');
            $table->foreign('campeonato_id')
                  ->references('id')
                  ->on('campeonatos')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('confrontos', function (Blueprint $table) {
            $table->dropForeign(['campeonato_id']);
            $table->dropColumn('campeonato_id');
        });
    }
}
