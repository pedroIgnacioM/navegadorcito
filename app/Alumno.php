<?php

namespace App;
use App\Curso;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    const nombre_plural='alumnos';
    const nombre_singular='alumno';
    const columnas_legibles =['nombres','apellido paterno','apellido materno','rut','email usuario'];
    const columnas_reales = ['nombres','apellido_paterno','apellido_materno','rut','user_fk'];
    protected $table = 'alumno';
    

    public function user_fk_elemento()
    {
        return $this->belongsTo('App\User','user_fk');
    }
    public function identificador(){
        return $this->nombres ." ". $this->apellido_paterno ." ". $this->apellido_materno;
    }
    public function asignaturas($rut,$agno,$semestre,$estado){
        if($estado=="Finalizado")
            $asignaturas=Curso::join('instanciacurso','instanciacurso.siglaCurso_fk','=','curso.sigla')
                                ->join('matriculainstanciacurso','matriculainstanciacurso.instanciaCurso_fk','=','instanciacurso.id')
                                ->where('instanciacurso.agno',$agno)
                                ->where('matriculainstanciacurso.rut_fk',$rut)
                                ->where('instanciacurso.semestre',$semestre)
                                ->select('curso.sigla','curso.nombre','matriculainstanciacurso.id','instanciacurso.profesor_fk')
                                ->get();
        else
            $asignaturas=Curso::join('instanciacurso','instanciacurso.siglaCurso_fk','=','curso.sigla')
                                    ->join('matriculainstanciacurso','matriculainstanciacurso.instanciaCurso_fk','=','instanciacurso.id')
                                    ->join('estadomatricula','estadomatricula.id','=','matriculainstanciacurso.estado_fk')
                                    ->where('instanciacurso.agno',$agno)
                                    ->where('matriculainstanciacurso.rut_fk',$rut)
                                    ->where('instanciacurso.semestre',$semestre)
                                    ->where('estadomatricula.estado',$estado)
                                    ->select('curso.sigla','curso.nombre','matriculainstanciacurso.id','instanciacurso.profesor_fk')
                                    ->get();
        return $asignaturas;
    }

    public function elementosDisponibles($columna_referencia,$id_elemento)
    {
        if(!isset($columna_referencia))
            return null;
        
        if($columna_referencia=='user_fk')
        {
            $usuarios_disponibles = User::leftJoin('alumno','alumno.user_fk','=','users.id')
                                        ->whereNull('alumno.user_fk')
                                        ->where('users.type','alumno')
                                        ->orWhere('alumno.user_fk',$id_elemento)
                                        ->select('users.*')
                                        ->get();
            return $usuarios_disponibles;
        }
        return null;
    }
    
    public function referencia($referencia){
        return 'rut';
    }
}
