@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h3>Agregar {{$nombre_singular}}</h3>
    <br>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
        <form action="{{route('insertar',$nombre_real)}}" method="post">
                {{csrf_field()}}
            <table class="table">
                @foreach (array_combine($columnas_reales,$columnas_legibles) as $columna_real =>$columna_legible)
                <tr>
                    <td><label for="{{$columna_real}}">{{$columna_legible}}</label></td>
                    @if ($columna_real=='type')
                        <td>
                            <select name="{{$columna_real}}" id="{{$columna_real}}" required>
                                <option value="">Seleccione una alternativa</option>
                                <optgroup label="tipos de usuario">
                                    <option value="alumno">alumno</option>
                                    <option value="profesor">profesor</option>
                                    <option value="admin">admin</option>
                            </select>
                        </td>
                    @else
                        @if (isset($lista1) && $columna_real==$lista1_fk)
                        <td>
                            <select name="{{$columna_real}}" id="{{$columna_real}}" required>
                                <option value="" selected>Seleccione uno</option>
                                @foreach ($lista1 as $elemento)
                                    <option value="{{$elemento->id}}">{{$elemento->identificador()}}</option>
                                @endforeach
                            </select>
                        </td> 
                        @else
                            @if (isset($lista2) && $columna_real==$lista2_fk)
                            <td>
                                <select name="{{$columna_real}}" id="{{$columna_real}}" required>
                                    <option value="" selected>Seleccione uno</option>
                                    @foreach ($lista2 as $elemento)
                                        <option value="{{$elemento->id}}">{{$elemento->identificador()}}</option>
                                    @endforeach
                                </select>
                            </td> 
                            @else
                                @if (isset($lista3) && $columna_real==$lista3_fk)
                                <td>
                                    <select name="{{$columna_real}}" id="{{$columna_real}}" required>
                                        <option value="" selected>Seleccione uno</option>
                                        @foreach ($lista3 as $elemento)
                                            <option value="{{$elemento->id}}">{{$elemento->identificador()}}</option>
                                        @endforeach
                                    </select>
                                </td> 
                                @else
                                    <td><input required name="{{$columna_real}}" id="{{$columna_real}}" type="text" placeholder="{{$columna_legible}}"></td>
                                @endif
                            @endif
                        @endif
                    @endif
                </tr>
                @endforeach
                <tr>
                    <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Agregar</button>    
                </td>    
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
                <a href="{{route('mantenedor',$nombre_real)}}"><button class="btn btn-lg btn-block">Cancelar</button></a>
        </div>
        <div class='ml-auto'>
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

