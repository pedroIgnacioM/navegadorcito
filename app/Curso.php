<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    const nombre_plural = 'cursos';
    const nombre_singular = 'curso';
    const columnas_legibles =['sigla','nombre','descripcion'];
    const columnas_reales = ['sigla','nombre','descripcion'];
    protected $table = 'curso';
    
    public function instanciaCursos()
    {
        return $this->hasMany('App\InstanciaCurso','siglaCurso_fk');
    }
    public function identificador(){
        return $this->sigla;
    }

    public function referencia($referencia){
        if($referencia=='siglaCurso_fk')
            return 'sigla';
        return null;
    }

}
