<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Curso;
use App\Profesor;

class InstanciaCurso extends Model
{
    const nombre_plural = "instancias de los cursos";
    const nombre_singular = "instancia del curso";
    const columnas_legibles = ['año','semestre','sigla del curso','profesor'];
    const columnas_reales = ['agno','semestre','siglaCurso_fk','profesor_fk'];
    protected $table = 'instanciaCurso';
    
    public function siglaCurso_fk_elemento()
    {
        return $this->belongsTo('App\Curso','siglaCurso_fk','sigla');
    }

    public function profesor_fk_elemento()
    {
        return $this->belongsTo('App\Profesor','profesor_fk','rut');
    }

    public function MatriculaInstanciaCursos()
    {
        return $this->hasMany('App\MatriculaInstanciaCurso');
    }
    public function identificador(){
        return $this->agno ." ". $this->semestre." ". $this->siglaCurso_fk;
    }

    public function elementosDisponibles($columna_referencia,$id_elemento)
    {
        if(!isset($columna_referencia))
            return null;
        
        if($columna_referencia=='siglaCurso_fk')
        {
            $cursos_disponibles = Curso::all();
            return $cursos_disponibles;
        }
        else if($columna_referencia=='profesor_fk')
        {
            $profesores_disponibles = Profesor::all();
            return $profesores_disponibles;
        } 
            
        return null;
    }

    public function referencia($referencia){
        return 'id';
    }
    
}
