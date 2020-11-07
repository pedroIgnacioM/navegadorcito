@extends('layouts.app')

@section('content')
<div class="container">
   <h1>Ficha Personal Alumno</h1>
    <p><b>RUT:</b> {{$alumno->rut}}</p>
    <p><b>Nombres:</b> {{$alumno->nombres}}</p>
    <p><b>Apellido Paterno:</b> {{$alumno->apellido_paterno}}</p>
    <p><b>Apellido Materno:</b> {{$alumno->apellido_materno}}</p>
</div>
<hr>
<div class="container">
    <h1>Asignaturas En Curso</h1>
    <h2>2018</h2>
    <h3>Semestre 1</h3>
    <ul>
        @foreach ($alumno->asignaturas($alumno->rut,'2018','primero','En curso') as $asignatura)
        @if ($asignatura->profesor_fk==$profesor->rut)
        <a href="{{route('curso_profesor',$asignatura->id)}}"><li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li></a>
        @else
            <li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li>
        @endif
        @endforeach
    </ul>
</div>
<hr>
<div class="container">
    <h1>Asignaturas Cursadas</h1>
    <h2>2017</h2>
    <h3>Semestre 2</h3>
    <ul>
        @foreach ($alumno->asignaturas($alumno->rut,'2017','segundo','Finalizado') as $asignatura)
        @if ($asignatura->profesor_fk==$profesor->rut)
        <a href="{{route('curso_profesor',$asignatura->id)}}"><li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li></a>
        @else
            <li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li>
        @endif
        @endforeach
    </ul>
    <br>
    <h3>Semestre 1</h3>
    <ul>
        @foreach ($alumno->asignaturas($alumno->rut,'2017','primero','Finalizado') as $asignatura)
        @if ($asignatura->profesor_fk==$profesor->rut)
        <a href="{{route('curso_profesor',$asignatura->id)}}"><li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li></a>
        @else
            <li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li>
        @endif
        @endforeach
    </ul>
    <br>
    <h2>2016</h2>
    <h3>Semestre 2</h3>
    <ul>
        @foreach ($alumno->asignaturas($alumno->rut,'2016','segundo','Finalizado') as $asignatura)
        @if ($asignatura->profesor_fk==$profesor->rut)
        <a href="{{route('curso_profesor',$asignatura->id)}}"><li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li></a>
        @else
            <li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li>
        @endif
        @endforeach
    </ul>
    <br>
    <h3>Semestre 1</h3>
    <ul>
        @foreach ($alumno->asignaturas($alumno->rut,'2016','primero','Finalizado') as $asignatura)
        @if ($asignatura->profesor_fk==$profesor->rut)
        <a href="{{route('curso_profesor',$asignatura->id)}}"><li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li></a>
        @else
            <li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li>
        @endif
        @endforeach
    </ul>
    <br>
</div>
@endsection