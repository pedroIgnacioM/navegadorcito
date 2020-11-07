@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Mantenedores </h2>
            <hr>
            <ul>
                <a href="/mantenedor/usuarios"><li>Usuarios</li></a>
                <a href="/mantenedor/alumnos"><li>Alumnos</li></a>
                <a href="/mantenedor/profesores"><li>Profesores</li></a>
                <a href="/mantenedor/cursos"><li>Cursos</li></a>
                <a href="/mantenedor/instancias_cursos"><li>Instancia Cursos</li></a>
                <a href="/mantenedor/matricula_instancia_cursos"><li>Matricula Instancia Cursos</li></a>
                <a href="/mantenedor/estado_matriculas"><li>Estado Matriculas</li></a>

            </ul>
            

        </div>
    </div>
</div>
@endsection


