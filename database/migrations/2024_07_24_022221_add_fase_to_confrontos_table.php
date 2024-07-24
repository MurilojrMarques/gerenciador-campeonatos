<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFaseToConfrontosTable extends Migration
{
    public function up()
    {
        Schema::table('confrontos', function (Blueprint $table) {
            $table->string('fase')->after('campeonato_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('confrontos', function (Blueprint $table) {
            $table->dropColumn('fase');
        });
    }
}
