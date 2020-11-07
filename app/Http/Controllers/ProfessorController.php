<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesor;
use App\EstadoMatricula;
use App\InstanciaCurso;
use App\Curso;
use App\MatriculaInstanciaCurso;
use App\Alumno;

class ProfessorController extends Controller
{
    

    public function index(){
        $usuario = \Auth::user();
        $profesor = Profesor::where('user_fk',$usuario->id)->first();
        return view('profesor',[
            'profesor'=>$profesor
        ]);

    }

    public function asignatura($id)
    {
        $instanciaCurso = InstanciaCurso::find($id);
        if(!isset($instanciaCurso))
            return redirect()->route('profesor');

        $matriculaInstanciaCurso = MatriculaInstanciaCurso::join('alumno','alumno.rut','=','matriculainstanciacurso.rut_fk')
                                            ->where('instanciaCurso_fk',$instanciaCurso->id)
                                            ->select('alumno.*','matriculainstanciacurso.estado_fk')
                                            ->get();

        if(!isset($matriculaInstanciaCurso))
            return redirect()->route('profesor');

        $curso = Curso::where('sigla',$instanciaCurso->siglaCurso_fk)->first();
        if(!isset($curso))
            return redirect()->route('profesor');

        $estado = EstadoMatricula::find($matriculaInstanciaCurso->first()->estado_fk);
        if(!isset($estado))
            return redirect()->route('profesor');

        if($estado->estado!="En curso")
            $estadoNuevo="Finalizado";
        else
            $estadoNuevo=$estado->estado;

        return view('curso_profesor',[
            'instanciaCurso'=>$instanciaCurso,
            'curso'=>$curso,
            'estado'=>$estadoNuevo,
            'alumnos_matriculados'=>$matriculaInstanciaCurso
        ]);
    }

    public function ficha_alumno($rut)
    {
        $usuario = \Auth::user();
        $profesor = Profesor::where('user_fk',$usuario->id)->first();
        $alumno = Alumno::where('rut',$rut)->first();
        if(!isset($alumno))
            return redirect()->route('profesor');

        return view('ficha_alumno',[
            'alumno'=>$alumno,
            'profesor'=>$profesor
        ]);
    }
}
