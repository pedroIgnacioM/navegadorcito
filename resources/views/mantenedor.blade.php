@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Mantenedor de {{$nombre_plural}}</h3>
    <br>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="container">
    <div class="row justify-content-center">
        <div class="text-center">
            <table class="table table-bordered table-responsive table-sm">
                @if (count($lista)>0)
                <thead class="thead-light">
                <tr>
                    {{-- Titulos de la tabla --}}
                    @foreach ($columnas_legibles as $columna_legible)
                        <th>{{ $columna_legible }}</th>
                    @endforeach
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                    {{-- Valores de la tabla --}}
                    @foreach ($lista as $elemento)
                        <tr id="{{$elemento->id}}">
                            @foreach ($columnas_reales as $columna_real)
                                @if (strpos($columna_real, '_fk') && isset($elemento->$columna_real))
                                    <td>{{$elemento->{$columna_real.'_elemento'}->identificador()}}</td>
                                @else
                                    <td>{{$elemento->$columna_real}}</td>
                                @endif
                            @endforeach
                            <td><a href="{{route('ventanaEditar',[$nombre_real,$elemento->id])}} "><button id="{{$elemento->id}}" class="btn btn-warning">Editar</button></a></td>
                            <td><button id="{{$elemento->id}}" class="btn btn-danger" onclick="borrarElemento('{{$elemento->id}}','{{$nombre_real}}')">Borrar</button></td>
                        </tr>
                    @endforeach
                    
                
                @else
                    <p>No existen {{$nombre_plural}} en este momento.</p>
                @endif  
                
            </table>
        </div>
        </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-2">
                <a href="{{route('admin')}}"><button class="btn btn-lg btn-block">Atras</button></a>
        </div>
        <div class='ml-auto'>
            <a href="{{route('agregar', $nombre_real)}}"><button id="boton_agregar" class="btn btn-primary btn-lg" style="margin-right:200px;">Agregar {{$nombre_singular}}</button></a>
        </div>
    </div>
        
</div>
<script>


    // function editarElemento(id_elemento,largo_tabla,nombre_real)
    // {      
    //     if($("#"+id_elemento+"_boton_editar").text()=="Editar")
    //     {
    //         $("."+id_elemento).attr('disabled',false);
    //         $("#boton_agregar").attr('disabled',true);

    //         $("#"+id_elemento+"_boton_editar").removeClass('btn-warning');
    //         $("#"+id_elemento+"_boton_editar").addClass('btn-primary');
    //         $("#"+id_elemento+"_boton_editar").html('Guardar');
            
    //         $("#"+id_elemento+"_boton_eliminar").attr('disabled',true);
    //     }
    //     else
    //     {
    //         $("."+id_elemento).attr('disabled',true);
    //         $("#boton_agregar").attr('disabled',false);

    //         $("#"+id_elemento+"_boton_editar").removeClass('btn-primary');
    //         $("#"+id_elemento+"_boton_editar").addClass('btn-warning');
    //         $("#"+id_elemento+"_boton_editar").html('Editar');
            
    //         $("#"+id_elemento+"_boton_eliminar").attr('disabled',false);


    //         // Funcionalidad editar
    //         var regex = /(\d+)/g;
    //         var id_limpio= id_elemento.match(regex);
    //         id_limpio = id_limpio[0];
    //         var elementos_json = JSON.stringify(obtenerJsonDatosNuevos(id_limpio));
    //         datos = {
    //             'elementos_json':elementos_json,
    //             'nombre': nombre_real,
    //             'id':id_limpio,
    //             "_token": $('#token').val()
    //         }
    //         console.log(datos);
    //         $.ajax({
    //             data: datos,
    //             url: "/editar",
    //             type: 'post',
    //             success: function(response){
    //                 if(response==false)
    //                 {
    //                     alert('no se pudo editar correctamente el elemento');
    //                     location.reload();
    //                 }
    //                 else
    //                     alert(response);

    //             }
    //         });
    //     }
            
    // }
    // //Obtiene un json con los nombres de las columnas y datos ingresados
    // function obtenerJsonDatosNuevos(id_elemento)
    // {
    //     keys=obtenerNombreColumnas(id_elemento);
    //     datos=obtenerDatosNuevos(id_elemento);
    //     resultado={};
    //     for(i=0;i<keys.length;i++)
    //     {
    //         resultado[keys[i]]=datos[i];
    //     }
    //     return resultado;

    // }

    // //Obtiene los nombres reales de los atributos del objeto
    // function obtenerNombreColumnas(id)
    // {
    //     elementos=[];
    //     $(".columna_"+id).each(function(){
    //             elementos.push($(this).text());
                
    //         });
    //     return elementos;
    // }

    // //Obtiene los datos de la tabla de la fila del id recibido
    // function obtenerDatosNuevos(id_elemento)
    // {
    //     id_final=id_elemento+"_elemento_tabla";
    //     datosNuevos=[];
    //     $("."+id_final).each(function(){
    //         datosNuevos.push($(this).val());
    //         });
    //     return datosNuevos;
    // }

    function borrarElemento(id_elemento,nombre_real)
    {
        mensaje = '¿Esta seguro de querer eliminar al elemento de forma permanente?'
        confirmacion = confirm(mensaje)
        if(confirmacion)
        {
            parametros={
                'id_elemento': id_elemento,
                'nombre': nombre_real,
                "_token": $('#token').val()
            }
            $.ajax({
                data: parametros,
                url: "/eliminar",
                type: 'post',
                
                success: function(response){
                    $("#"+id_elemento).remove();
                    alert(response);
                    
                }
            });
        }

    }
</script>
@endsection
