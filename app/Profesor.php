<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    const nombre_plural = 'profesores';
    const nombre_singular = 'profesor';
    const columnas_legibles = ['nombres','apellido paterno','apellido materno','rut','email usuario'];
    const columnas_reales = ['nombres','apellido_paterno','apellido_materno','rut','user_fk'];

    protected $table = 'profesor';
    
    public function user_fk_Elemento()
    {
        return $this->belongsTo('App\User','user_fk');
    }
    public function instanciasCursos()
    {
        return $this->hasMany('App\InstanciaCurso','profesor_fk');
    }
    public function identificador(){
        return $this->nombres ." ". $this->apellido_paterno ." ". $this->apellido_materno;
    }

    public function asignaturas($rut,$agno,$semestre){

        $asignaturas=Curso::join('instanciacurso','instanciacurso.siglaCurso_fk','=','curso.sigla')
                            ->where('instanciacurso.agno',$agno)
                            ->where('instanciacurso.profesor_fk',$rut)
                            ->where('instanciacurso.semestre',$semestre)
                            ->select('curso.sigla','curso.nombre','instanciacurso.id')
                            ->get();
        return $asignaturas;
    }

    public function elementosDisponibles($columna_referencia,$id_elemento)
    {
        if(!isset($columna_referencia))
            return null;
        
        if($columna_referencia=='user_fk')
        {
            $usuarios_disponibles = User::leftJoin('profesor','profesor.user_fk','=','users.id')
                                        ->whereNull('profesor.user_fk')
                                        ->where('users.type','profesor')
                                        ->orWhere('profesor.user_fk',$id_elemento)
                                        ->select('users.*')
                                        ->get();
            return $usuarios_disponibles;
        }
        return null;
    }
    public function referencia($referencia)
    {
        return 'rut';
    }
}
