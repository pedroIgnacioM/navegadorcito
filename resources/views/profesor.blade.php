@extends('layouts.app')

@section('content')
<div class="container">
   <h1>Ficha Personal Profesor</h1>
    <p><b>RUT:</b> {{$profesor->rut}}</p>
    <p><b>Nombres:</b> {{$profesor->nombres}}</p>
    <p><b>Apellido Paterno:</b> {{$profesor->apellido_paterno}}</p>
    <p><b>Apellido Materno:</b> {{$profesor->apellido_materno}}</p>
</div>
<div class="container">
    <h1>Asignaturas En Curso</h1>
    <h2>2018</h2>
    <h3>Semestre 1</h3>
    <ul>
        @foreach ($profesor->asignaturas($profesor->rut,'2018','primero','En curso') as $asignatura)
        <a href="{{route('curso_profesor',$asignatura->id)}}"><li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li></a>
        @endforeach
    </ul>
</div>
<div class="container">
    <h1>Asignaturas Cursadas</h1>
    <h2>2017</h2>
    <h3>Semestre 2</h3>
    <ul>
        @foreach ($profesor->asignaturas($profesor->rut,'2017','segundo','Finalizado') as $asignatura)
        <a href="{{route('curso_profesor',$asignatura->id)}}"><li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li></a>
        @endforeach
    </ul>
    <br>
    <h3>Semestre 1</h3>
    <ul>
        @foreach ($profesor->asignaturas($profesor->rut,'2017','primero','Finalizado') as $asignatura)
        <a href="{{route('curso_profesor',$asignatura->id)}}"><li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li></a>
        @endforeach
    </ul>
    <br>
    <h2>2016</h2>
    <h3>Semestre 2</h3>
    <ul>
        @foreach ($profesor->asignaturas($profesor->rut,'2016','segundo','Finalizado') as $asignatura)
        <a href="{{route('curso_profesor',$asignatura->id)}}"><li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li></a>
        @endforeach
    </ul>
    <br>
    <h3>Semestre 1</h3>
    <ul>
        @foreach ($profesor->asignaturas($profesor->rut,'2016','primero','Finalizado') as $asignatura)
        <a href="{{route('curso_profesor',$asignatura->id)}}"><li>{{$asignatura->sigla}} {{$asignatura->nombre}}</li></a>
        @endforeach
    </ul>
    <br>
</div>
@endsection