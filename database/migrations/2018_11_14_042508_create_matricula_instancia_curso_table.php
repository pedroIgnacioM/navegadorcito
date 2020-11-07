<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatriculaInstanciaCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculaInstanciaCurso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut_fk',10)->nullable();
            $table->unsignedInteger('nota')->nullable();
            $table->unsignedInteger('estado_fk')->nullable();
            $table->unsignedInteger('instanciaCurso_fk')->nullable();
            $table->timestamps();
            $table->foreign('rut_fk')->references('rut')->on('alumno')->onDelete('set null');
            $table->foreign('instanciaCurso_fk')->references('id')->on('instanciaCurso')->onDelete('set null');
            $table->foreign('estado_fk')->references('id')->on('estadoMatricula')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculaInstanciaCurso');
    }
}
