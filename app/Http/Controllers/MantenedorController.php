<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Curso;
use App\InstanciaCurso;
use App\MatriculaInstanciaCurso;
use App\Alumno;
use App\Profesor;
use App\EstadoMatricula;

class MantenedorController extends Controller
{
    //vista principal del administrador
    public function ventanaPrincipal()
    {
            return view('admin');
    }

    //vista principal de un elemento en especifico
    public function ventanaPrincipalElemento($nombre)
    {
        if(!isset($nombre))
            return view('admin');

        if($nombre=='usuarios')
        {
            $lista=User::all();
            $nombre_plural=User::nombre_plural;
            $nombre_singular=User::nombre_singular;
            $columnas_legibles=User::columnas_legibles;
            $columnas_reales=User::columnas_reales;
        }
        else if($nombre=='alumnos')
        {
            $lista=Alumno::all();
            $nombre_plural=Alumno::nombre_plural;
            $nombre_singular=Alumno::nombre_singular;
            $columnas_legibles=Alumno::columnas_legibles;
            $columnas_reales=Alumno::columnas_reales;
            
        }
        else if($nombre=='profesores')
        {
            $lista=Profesor::all();
            $nombre_plural=Profesor::nombre_plural;
            $nombre_singular=Profesor::nombre_singular;
            $columnas_legibles=Profesor::columnas_legibles;
            $columnas_reales=Profesor::columnas_reales;
        }
        else if($nombre=='cursos')
        {
            $lista=Curso::all();
            $nombre_plural=Curso::nombre_plural;
            $nombre_singular=Curso::nombre_singular;
            $columnas_legibles=Curso::columnas_legibles;
            $columnas_reales=Curso::columnas_reales;
        }
        else if($nombre=='instancias_cursos')
        {
            $lista=InstanciaCurso::all();
            $nombre_plural=InstanciaCurso::nombre_plural;
            $nombre_singular=InstanciaCurso::nombre_singular;
            $columnas_legibles=InstanciaCurso::columnas_legibles;
            $columnas_reales=InstanciaCurso::columnas_reales;
        }
        else if($nombre=='matricula_instancia_cursos')
        {
            $lista=MatriculaInstanciaCurso::all();
            $nombre_plural=MatriculaInstanciaCurso::nombre_plural;
            $nombre_singular=MatriculaInstanciaCurso::nombre_singular;
            $columnas_legibles=MatriculaInstanciaCurso::columnas_legibles;
            $columnas_reales=MatriculaInstanciaCurso::columnas_reales;
        }
        else if($nombre=='estado_matriculas')
        {
            $lista=EstadoMatricula::all();
            $nombre_plural=EstadoMatricula::nombre_plural;
            $nombre_singular=EstadoMatricula::nombre_singular;
            $columnas_legibles=EstadoMatricula::columnas_legibles;
            $columnas_reales=EstadoMatricula::columnas_reales;
        }
        else
            return view('admin');
        return view('mantenedor',[
                'lista'=>$lista,
                'nombre_plural'=>$nombre_plural,
                'nombre_singular'=>$nombre_singular,
                'nombre_real'=>$nombre,
                'columnas_legibles'=>$columnas_legibles,
                'columnas_reales'=>$columnas_reales
            ]);
    }

    //vista para agregar un elemento en especifico
    public function ventanaAgregar($nombre)
    {
        if(!isset($nombre))
            return view('admin');

        if($nombre=='usuarios')
        {
            $nombre_singular=User::nombre_singular;
            $columnas_legibles=User::columnas_legibles;
            $columnas_reales=User::columnas_reales;
            $lista1=null;
            $lista2=null;
            $lista3=null;
            $lista1_fk=null;
            $lista2_fk=null;
            $lista3_fk=null;
            
        }
        else if($nombre=='alumnos')
        {
            $nombre_singular=Alumno::nombre_singular;
            $columnas_legibles=Alumno::columnas_legibles;
            $columnas_reales=Alumno::columnas_reales;
            $lista1=User::leftJoin('alumno','users.id','=','alumno.user_fk')
                                        ->select('users.*')
                                        ->where('type','Alumno')
                                        ->whereNull('alumno.user_fk')
                                        ->get();
            $lista2=null;
            $lista3=null;
            $lista1_fk='user_fk';
            $lista2_fk=null;
            $lista3_fk=null;
            
        }
        else if($nombre=='profesores')
        {
            $nombre_singular=Profesor::nombre_singular;
            $columnas_legibles=Profesor::columnas_legibles;
            $columnas_reales=Profesor::columnas_reales;
            $lista1= User::leftJoin('profesor','users.id','=','profesor.user_fk')
                                    ->select('users.*')
                                    ->where('type','Profesor')
                                    ->whereNull('profesor.user_fk')
                                    ->get();
            $lista2=InstanciaCurso::all();
            $lista3=null;
            $lista1_fk='user_fk';
            $lista2_fk='instanciaCurso_fk';
            $lista3_fk=null;
        }
        else if($nombre=='cursos')
        {
            $nombre_singular=Curso::nombre_singular;
            $columnas_legibles=Curso::columnas_legibles;
            $columnas_reales=Curso::columnas_reales;
            $lista1=null;
            $lista2=null;
            $lista3=null;
            $lista1_fk=null;
            $lista2_fk=null;
            $lista3_fk=null;
        }
        else if($nombre=='instancias_cursos')
        {
            $nombre_singular=InstanciaCurso::nombre_singular;
            $columnas_legibles=InstanciaCurso::columnas_legibles;
            $columnas_reales=InstanciaCurso::columnas_reales;
            $lista1=Profesor::all();
            $lista2=Curso::all();
            $lista3=null;
            $lista1_fk='profesor_fk';
            $lista2_fk='siglaCurso_fk';
            $lista3_fk=null;
        }
        else if($nombre=='matricula_instancia_cursos')
        {
            $nombre_singular=MatriculaInstanciaCurso::nombre_singular;
            $columnas_legibles=MatriculaInstanciaCurso::columnas_legibles;
            $columnas_reales=MatriculaInstanciaCurso::columnas_reales;
            $lista1=Alumno::all();
            $lista2=InstanciaCurso::all();
            $lista3=EstadoMatricula::all();
            $lista1_fk='rut_fk';
            $lista2_fk='instanciaCurso_fk';
            $lista3_fk='estado_fk';
        }
        else if($nombre=='estado_matriculas')
        {
            $nombre_singular=EstadoMatricula::nombre_singular;
            $columnas_legibles=EstadoMatricula::columnas_legibles;
            $columnas_reales=EstadoMatricula::columnas_reales;
            $lista1=null;
            $lista2=null;
            $lista3=null;
            $lista1_fk=null;
            $lista2_fk=null;
            $lista3_fk=null;
        }
        else
            return view('admin');
        return view('mantenedor_agregar',[
                'columnas_legibles'=>$columnas_legibles,
                'columnas_reales'=>$columnas_reales,
                'nombre_singular'=>$nombre_singular,
                'nombre_real'=>$nombre,
                'lista1'=>$lista1,
                'lista2'=>$lista2,
                'lista3'=>$lista3,
                'lista1_fk'=>$lista1_fk,
                'lista2_fk'=>$lista2_fk,
                'lista3_fk'=>$lista3_fk,
            ]);
    }

    public function ventanaEditar($nombre,$id_elemento)
    {
        if(!isset($nombre))
            return view('admin');

        if($nombre=='usuarios')
        {
            $elemento= User::find($id_elemento);
            $nombre_singular=User::nombre_singular;
            $columnas_legibles=User::columnas_legibles;
            $columnas_reales=User::columnas_reales;
            
        }
        else if($nombre=='alumnos')
        {
            $elemento= Alumno::find($id_elemento);
            $nombre_singular=Alumno::nombre_singular;
            $columnas_legibles=Alumno::columnas_legibles;
            $columnas_reales=Alumno::columnas_reales;
   
            
        }
        else if($nombre=='profesores')
        {
            $elemento= Profesor::find($id_elemento);
            $nombre_singular=Profesor::nombre_singular;
            $columnas_legibles=Profesor::columnas_legibles;
            $columnas_reales=Profesor::columnas_reales;

        }
        else if($nombre=='cursos')
        {
            $elemento= Curso::find($id_elemento);
            $nombre_singular=Curso::nombre_singular;
            $columnas_legibles=Curso::columnas_legibles;
            $columnas_reales=Curso::columnas_reales;

        }
        else if($nombre=='instancias_cursos')
        {
            $elemento= InstanciaCurso::find($id_elemento);
            $nombre_singular=InstanciaCurso::nombre_singular;
            $columnas_legibles=InstanciaCurso::columnas_legibles;
            $columnas_reales=InstanciaCurso::columnas_reales;

        }
        else if($nombre=='matricula_instancia_cursos')
        {
            $elemento= MatriculaInstanciaCurso::find($id_elemento);
            $nombre_singular=MatriculaInstanciaCurso::nombre_singular;
            $columnas_legibles=MatriculaInstanciaCurso::columnas_legibles;
            $columnas_reales=MatriculaInstanciaCurso::columnas_reales;

        }
        else if($nombre=='estado_matriculas')
        {
            $elemento= EstadoMatricula::find($id_elemento);
            $nombre_singular=EstadoMatricula::nombre_singular;
            $columnas_legibles=EstadoMatricula::columnas_legibles;
            $columnas_reales=EstadoMatricula::columnas_reales;
        }
        else
            return view('admin');
        if(!isset($elemento))
            return view('admin');
        return view('mantenedor_editar',[
                'elementoEditar'=>$elemento,
                'columnas_legibles'=>$columnas_legibles,
                'columnas_reales'=>$columnas_reales,
                'nombre_singular'=>$nombre_singular,
                'nombre_real'=>$nombre,
            ]);
    }
//---------------------------------Funciones POST ----------------------------------

    //funcion post para insertar un elemento en la base de datos
    public function insertarElemento(Request $request, $nombre)
    {
        if(!isset($nombre))
            return view('admin');


        if($nombre=='usuarios')
        {
            $nuevo = new User();

            $nuevo->name= $request->name;
            $nuevo->email = $request->email;
            $nuevo->type = $request->type;
            $nuevo->password = bcrypt($request->password);
            
            $nuevo->save();
        }
        else if($nombre=='alumnos')
        {
            $nuevo = new Alumno();

            $nuevo->rut = $request->rut;
            $nuevo->nombres = $request->nombres;
            $nuevo->apellido_paterno = $request->apellido_paterno;
            $nuevo->apellido_materno = $request->apellido_materno;
            $nuevo->user_fk = $request->user_fk;

            $nuevo->save();
        }
        else if($nombre=='profesores')
        {
            $nuevo = new Profesor();

            $nuevo->rut = $request->rut;
            $nuevo->nombres = $request->nombres;
            $nuevo->apellido_paterno = $request->apellido_paterno;
            $nuevo->apellido_materno = $request->apellido_materno;
            $nuevo->user_fk = $request->user_fk;
            

            $nuevo->save();
        }
        else if($nombre=='cursos')
        {
            $nuevo = new Curso();

            $nuevo->sigla = $request->sigla;
            $nuevo->nombre = $request->nombre;
            $nuevo->descripcion = $request->descripcion;

            $nuevo->save();
        }
        else if($nombre=='instancias_cursos')
        {
            $nuevo = new InstanciaCurso();

            $nuevo->agno = $request->agno;
            $nuevo->semestre = $request->semestre;
            $nuevo->sigla_curso = $request->sigla_curso;
            
            $nuevo->save();
        }
        else if($nombre=='matricula_instancia_cursos')
        {
            $nuevo = new MatriculaInstanciaCurso();

            $nuevo->rut = $request->rut;;
            $nuevo->estado = $request->estado;
            $nuevo->instancia_curso = $request->instancia_curso;

            $nuevo->save();
        }
        else if($nombre=='estado_matriculas')
        {
            $nuevo = new EstadoMatricula();

            $nuevo->estado = $request->estado;

            $nuevo->save();
        }
        else
            return view('admin');
        return redirect()->route('mantenedor',$nombre);
    }
    
    //funcion post para eliminar un elemento en la base de datos
    public function eliminarElemento(Request $request)
    {
        if($request->nombre=='usuarios')
        {
            $elemento=User::find($request->id_elemento);
            if($elemento->type=="alumno")
            {
                $alumno_referencia= Alumno::where('user_fk',$elemento->id)->first();
                if(isset($alumno_referencia))
                {
                    $alumno_referencia->user_fk=null;
                }
            }
            else if($elemento->type=="profesor")
            {
                $profesor_referencia= Profesor::where('user_fk',$elemento->id)->first();
                if(isset($profesor_referencia))
                {
                    $profesor_referencia->user_fk=null;
                }
            }
            $elemento->delete();
            
        }
        else if($request->nombre=='alumnos')
        {
            $elemento=Alumno::find($request->id_elemento);
            $referencias = MatriculaInstanciaCurso::where('rut_fk',$elemento->rut)->get();
            foreach ($referencias as $referencia) {
                $referencia->rut_fk=null;
                $referencia->save();
            }
            $elemento->delete();
        }    
        else if($request->nombre=='profesores')
        {
            $elemento=Profesor::find($request->id_elemento);
            $referencias = InstanciaCurso::where('profesor_fk',$elemento->rut)->get();
            foreach ($referencias as $referencia) {
                $referencia->profesor_fk=null;
                $referencia->save();
            }

            $elemento->delete();
        }
        else if($request->nombre=='cursos')
        {
            $elemento_eliminar=Curso::find($request->id_elemento);
            $referencias = InstanciaCurso::where('siglaCurso_fk',$elemento->sigla)->get();
            foreach ($referencias as $referencia) {
                $referencia->siglaCurso_fk=null;
                $referencia->save();
            }
            $elemento->delete();
        }   
        else if($request->nombre=='instancias_cursos')
        {
            $elemento=InstanciaCurso::find($request->id_elemento);
            $referencias = MatriculaInstanciaCurso::where('instanciaCurso_fk',$elemento->id)->get();
            foreach ($referencias as $referencia) {
                $referencia->instanciaCurso_fk=null;
                $referencia->save();
            }
            $elemento->delete();
        }    
        else if($request->nombre=='matricula_instancia_cursos')
        {
            $elemento=MatriculaInstanciaCurso::find($request->id_elemento);
            $elemento->delete();
        }    
        else if($request->nombre=='estado_matriculas')
        {
            $elemento=EstadoMatricula::find($request->id_elemento);
            $referencias = MatriculaInstanciaCurso::where('estado_fk',$elemento->id)->get();
            foreach ($referencias as $referencia) {
                $referencia->estado_fk=null;
                $referencia->save();
            }
            $elemento->delete();

        }    

        echo('El elemento fue eliminado con éxito');
        
    }

    //funcion post para editar un elemento en la base de datos
    public function editarElemento(Request $request,$nombre)
    {
        if($nombre=='usuarios')
        { 
            $elemento_editar=User::find($request->id);
            if(isset($elemento_editar))
            {
                $elemento_editar->name=$request->name;
                $elemento_editar->email=$request->email;
                $elemento_editar->type=$request->type;
                $elemento_editar->save();
                echo('El usuario se editó correctamente');
            }
        }
        else if($nombre=='profesores')
        {
            $elemento_editar=Profesor::find($request->id); 
            if(isset($elemento_editar))
            {
                $elemento_editar->rut = $request->rut;
                $elemento_editar->nombres = $request->nombres;
                $elemento_editar->apellido_paterno = $request->apellido_paterno;
                $elemento_editar->apellido_materno = $request->apellido_materno;
                $elemento_editar->user_fk = $request->user_fk;
                $elemento_editar->save();
                echo('El profesor se editó correctamente');
            }
        }
        else if($nombre=='alumnos')
        {
            $elemento_editar=Alumno::find($request->id);
            if(isset($elemento_editar))
            {
                $elemento_editar->rut = $request->rut;
                $elemento_editar->nombres = $request->nombres;
                $elemento_editar->apellido_paterno = $request->apellido_paterno;
                $elemento_editar->apellido_materno = $request->apellido_materno;
                $elemento_editar->user_fk = $request->user_fk;
                $elemento_editar->save();
                echo('El alumno se editó correctamente');
            }
        }
        else if($nombre=='cursos')
        {
            $elemento_editar=Curso::find($request->id);
            if(isset($elemento_editar))
            {
                $elemento_editar->sigla = $request->sigla;
                $elemento_editar->nombre = $request->nombre;
                $elemento_editar->descripcion = $request->descripcion;
                $elemento_editar->save();
                echo('El curso se editó correctamente');
            }
        }
        else if($nombre=='instancias_cursos')
        {
            $elemento_editar=InstanciaCurso::find($request->id);
            if(isset($elemento_editar))
            {
                $elemento_editar->agno = $request->agno;
                $elemento_editar->semestre = $request->semestre;
                $elemento_editar->siglaCurso_fk = $request->siglaCurso_fk;
                $elemento_editar->profesor_fk = $request->profesor_fk;
                $elemento_editar->save();
                echo('La instancia del curso se editó correctamente');
            }
        }
        else if($nombre=='matricula_instancia_cursos')
        {
            $elemento_editar=MatriculaInstanciaCurso::find($request->id);
            if(isset($elemento_editar))
            {
                $elemento_editar->rut_fk = $request->rut_fk;
                $elemento_editar->estado_fk = $request->estado_fk;
                $elemento_editar->instanciaCurso_fk = $request->instanciaCurso_fk;
                $elemento_editar->save();
                echo('La matricula de la instancia del curso se editó correctamente');
            }
        }
        else if($nombre=='estado_matriculas')
        {
            $elemento_editar=EstadoMatricula::find($request->id);
            if(isset($elemento_editar))
            {
                $elemento_editar->estado = $request->estado;
                $elemento_editar->save();
                echo('El estado de la matricula se editó correctamente');
            }
        }
        else
            echo('No se pudo editar el elemento');

        return redirect()->route('mantenedor',$nombre);
    }
}
