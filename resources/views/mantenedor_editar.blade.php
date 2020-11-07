@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h3>Editar {{$nombre_singular}}</h3>
    <br>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <form action="{{route('editar',$nombre_real)}}" method="post">
                {{csrf_field()}}
            <table class="table">
                <tr>
                        <td><input name="id" hidden type="text" value="{{$elementoEditar->id}}"></td>
                </tr>
                @foreach (array_combine($columnas_reales,$columnas_legibles) as $columna_real =>$columna_legible)
                <tr>
                    <td><label for="{{$columna_real}}">{{$columna_legible}}</label></td>
                    @if (strpos($columna_real, '_fk'))
                        <td>
                            <select name="{{$columna_real}}" id="{{$columna_real}}" required>
                                @foreach ($elementoEditar->elementosDisponibles($columna_real,$elementoEditar->$columna_real) as $elemento)
                                    @if ($elementoEditar->$columna_real==$elemento->{$elemento->referencia($columna_real)})
                                        <option value="{{ $elemento->{$elemento->referencia($columna_real)} }}" selected>{{$elemento->identificador()}}</option>
                                    @else
                                        <option value="{{ $elemento->{$elemento->referencia($columna_real)} }}">{{$elemento->identificador()}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td> 
                    @else
                        <td><input name="{{$columna_real}}" type="text" value="{{$elementoEditar->$columna_real}}"></td>
                    @endif      
                </tr>
                @endforeach   
            <tr>
                <td></td>
                <td></td>
                <td><input type="submit" class="btn btn-primary btn-lg" value="Editar"></td>
            </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-2">
                <a href="{{route('admin')}}"><button class="btn btn-lg btn-block">Atras</button></a>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#password').attr('type','password');
    $('#type').attr('')
});
</script>

@endsection