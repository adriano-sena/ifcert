<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evento_id'); //fk do evento
            $table->string('titulo');
            $table->string('subtitulo');
            $table->string('slug');
            $table->text('descricao');
            $table->string('mediador');
            $table->integer('cargaHoraria');
            $table->string('local');
            $table->date('data');
            $table->timestamps();

            //Constraint da fk 
            $table->foreign('evento_id')->references('id')->on('eventos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividades');
    }
}
