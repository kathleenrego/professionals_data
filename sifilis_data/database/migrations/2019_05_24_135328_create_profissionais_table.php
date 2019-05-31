<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfissionaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profissionais', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('cns');
            $table->date('data_atribuicao')->nullable();
            $table->integer('cbo_id')->unsigned();
            $table->integer('vinculo_id')->unsigned();
            $table->integer('tipo_id')->unsigned();
            $table->integer('carga_horaria');
            $table->boolean('sus');

            $table->foreign('cbo_id')->references('id')->on('cbos');
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->foreign('vinculo_id')->references('id')->on('vinculos');


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
        Schema::dropIfExists('profissionais');
    }
}
