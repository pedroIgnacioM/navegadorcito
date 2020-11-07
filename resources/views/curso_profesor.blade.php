@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asignatura: {{$curso->sigla}} {{$curso->nombre}}</h1>
    <p><b>Descripción</b></p>
    <p>{{$curso->descripcion}}</p>
    <p><b>Dictada en:</b> {{$instanciaCurso->agno}} / {{$instanciaCurso->semestre}}</p>
    <p><b>Estado:</b> {{$estado}}</p>

</div>
<div class="container">
    <h1>Alumnos Matriculados</h1>
    <div class="text-center">
        <table class="table table-responsive table-sm">
            <thead class="thead-light">
            <tr>
                <th>Rut</th>
                <th>Nombres</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Ficha</th>
            </tr>
            </thead>
            @foreach ($alumnos_matriculados as $alumno)
            <tr>
                <td>{{$alumno->rut}}</td>
                <td>{{$alumno->nombres}}</td>
                <td>{{$alumno->apellido_paterno}}</td>
                <td>{{$alumno->apellido_materno}}</td>
                <td><a href="{{route('ficha_alumno',$alumno->rut)}}">Ver Ficha</a></td>

            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection