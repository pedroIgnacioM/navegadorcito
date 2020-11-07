<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstanciaCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instanciacurso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agno',5);
            $table->string('semestre',15);
            $table->string('siglaCurso_fk')->nullable();
            $table->string('profesor_fk',10)->nullable();
            $table->timestamps();
            
            $table->foreign('profesor_fk')->references('rut')->on('profesor')->onDelete('set null');
            $table->foreign('siglaCurso_fk')->references('sigla')->on('curso')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instanciacurso');
    }
}
