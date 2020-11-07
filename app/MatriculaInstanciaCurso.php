<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EstadoMatricula;
use App\InstanciaCurso;
use App\Alumno;

class MatriculaInstanciaCurso extends Model
{
    protected $table = 'matriculaInstanciaCurso';
    const columnas_legibles = ['alumno','estado','instancia curso'];
    const columnas_reales = ['rut_fk','estado_fk','instanciaCurso_fk'];
    const nombre_singular = 'matricula de instancia de curso';
    const nombre_plural = 'matriculas de instancias de cursos';
    public function instanciaCurso_fk_elemento()
    {
        return $this->belongsTo('App\InstanciaCurso','instanciaCurso_fk');
    }
    public function estado_fk_elemento()
    {
        return $this->belongsTo('App\EstadoMatricula','estado_fk');
    }
    public function rut_fk_elemento()
    {
        return $this->belongsTo('App\Alumno','rut_fk','rut');
    }
    public function identificador(){
        return $this->sigla ." ". $this->agno." ". $this->rut_fk;
    }

    public function elementosDisponibles($columna_referencia,$id_elemento)
    {
        if(!isset($columna_referencia))
            return null;
        
        if($columna_referencia=='estado_fk')
        {
            $estados_disponibles = EstadoMatricula::all();
            return $estados_disponibles;
        }
        else if($columna_referencia=='rut_fk')
        {
            $alumnos_disponibles = Alumno::all();
            return $alumnos_disponibles;
        }
        else if($columna_referencia=='instanciaCurso_fk')
        {
            $instancias_disponibles = InstanciaCurso::all();
            return $instancias_disponibles;
        } 
            
        return null;
    }

}
