@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asignatura: {{$curso->sigla}} {{$curso->nombre}}</h1>
    <p><b>Descripción</b></p>
    <p>{{$curso->descripcion}}</p>
    <p><b>Profesor:</b> {{$nombre_profesor}}</p>
    <p><b>Cursada en:</b> {{$instanciaCurso->agno}} {{$instanciaCurso->semestre}}</p>
    <p><b>Estado:</b> {{$estado}}</p>
    @if (isset($nota))
        <p><b>Nota Final: </b>{{$nota}}</p>
    @else
        <p><b>Nota Final:</b> (aun no disponible)</p>
    @endif

</div>


@endsection