<?php

use App\Http\Controllers\AlumnoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Rutas del alumno
Route::group(['middleware' => 'is_alumno'], function(){
    Route::get('/alumno', 'AlumnoController@index')->name('alumno');
    Route::get('/asignatura_alumno/{id}', 'AlumnoController@asignatura')->name('curso_alumno');
});

//Rutas del profesor
Route::group(['middleware' => 'is_professor'], function(){
    Route::get('/profesor','ProfessorController@index')->name('profesor');
    Route::get('/asignatura_profesor/{id}', 'ProfessorController@asignatura')->name('curso_profesor');
    Route::get('/ficha_alumno/{rut}', 'ProfessorController@ficha_alumno')->name('ficha_alumno');
});





//Rutas del mantenedor del admin
Route::group(['middleware' => 'is_admin'], function () {
    
    Route::get('/admin', 'MantenedorController@ventanaPrincipal')->name('admin');
    Route::get('/mantenedor/{nombre}/agregar', 'MantenedorController@ventanaAgregar')->name('agregar');
    Route::get('/mantenedor/{nombre}', 'MantenedorController@ventanaPrincipalElemento')->name('mantenedor');
    Route::get('/mantenedor/{nombre}/editar/{id_elemento}', 'MantenedorController@ventanaEditar')->name('ventanaEditar');

    Route::post('/insertar/{nombre}','MantenedorController@insertarElemento')->name('insertar');
    Route::post('/editar/{nombre}','MantenedorController@editarElemento')->name('editar');
    Route::post('/eliminar','MantenedorController@eliminarElemento')->name('eliminar');

});


