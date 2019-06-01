<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVinculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('carga_horaria');
            $table->date('data_atribuicao')->nullable();

            $table->integer('cbo_id')->unsigned();
            $table->integer('vinculacao_id')->unsigned();
            $table->integer('profissional_id')->unsigned();
            $table->integer('tipo_id')->unsigned();

            $table->foreign('cbo_id')->references('id')->on('cbos');
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->foreign('vinculacao_id')->references('id')->on('vinculacoes');
            $table->foreign('profissional_id')->references('id')->on('profissionais');

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
        Schema::dropIfExists('vinculos');
    }
}
