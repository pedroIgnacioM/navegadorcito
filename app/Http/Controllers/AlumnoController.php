<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\MatriculaInstanciaCurso;
use App\Curso;
use App\InstanciaCurso;
use App\Profesor;
use App\EstadoMatricula;

class AlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $usuario = \Auth::user();
        $alumno = Alumno::where('user_fk',$usuario->id)->first();
        return view('alumno',[
            'alumno'=>$alumno
        ]);
    }
    public function asignatura($id)
    {
        $matriculaInstanciaCurso = MatriculaInstanciaCurso::find($id);
        if(!isset($matriculaInstanciaCurso))
            return redirect()->route('alumno');

        $instanciaCurso = InstanciaCurso::find($matriculaInstanciaCurso->instanciaCurso_fk);
        if(!isset($instanciaCurso))
            return redirect()->route('alumno');

        $curso = Curso::where('sigla',$instanciaCurso->siglaCurso_fk)->first();
        if(!isset($curso))
            return redirect()->route('alumno');

        $profesor = Profesor::where('rut',$instanciaCurso->profesor_fk)->first();
        if(!isset($profesor))
            return redirect()->route('alumno');

        $estado = EstadoMatricula::find($matriculaInstanciaCurso->estado_fk);
        if(!isset($estado))
            return redirect()->route('alumno');


        return view('curso_alumno',[
            'instanciaCurso'=>$instanciaCurso,
            'curso'=>$curso,
            'nombre_profesor'=>$profesor->nombres,
            'estado'=>$estado->estado,
            'nota'=>$matriculaInstanciaCurso->nota
        ]);
    }
}
