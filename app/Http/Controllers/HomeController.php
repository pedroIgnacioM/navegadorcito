<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        if($user->type=='admin')
            return redirect()->route('admin');
        else if($user->type=='alumno')
            return redirect()->route('alumno');
        else if($user->type=='profesor')
            return redirect()->route('profesor');
        return view('home');
    }
}
