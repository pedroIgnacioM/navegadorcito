<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Curso;
use App\InstanciaCurso;
use App\MatriculaInstanciaCurso;
use App\Alumno;
use App\EstadoMatricula;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
