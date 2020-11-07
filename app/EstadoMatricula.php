<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoMatricula extends Model
{
    const nombre_plural = 'estados de matriculas';
    const nombre_singular = 'estado de la matricula';
    const columnas_legibles =['estado'];
    const columnas_reales = ['estado'];
    protected $table = 'estadoMatricula';
    
    public function MatriculaInstanciaCursos()
    {
        return $this->hasMany('App\MatriculaInstanciaCurso','estado_fk');
    }
    public function identificador(){
        return $this->estado;
    }
    
    public function referencia($referencia)
    {
        return 'id';
    }

}
