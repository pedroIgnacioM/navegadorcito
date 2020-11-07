<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{
    use Notifiable;
    const ADMIN_TYPE = 'admin';
    const ALUMNO_TYPE = 'alumno';
    const PROFESOR_TYPE = 'profesor';
    const DEFAULT_TYPE = 'default';
    const nombre_plural = 'usuarios';
    const nombre_singular = 'usuario';
    const columnas_legibles = ['nombre','correo','tipo de usuario'];
    const columnas_reales = ['name','email','type'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function alumno()
    {
        return $this->hasOne('App\Alumno','user_fk');
    }
    public function profesor()
    {
        return $this->hasOne('App\Profesor','user_fk');
    }

    public function isAdmin()    {        
        return $this->type === self::ADMIN_TYPE;    
    }
    public function isProfessor()    {        
        return $this->type === self::PROFESOR_TYPE;    
    }
    public function isAlumno()    {        
        return $this->type === self::ALUMNO_TYPE;    
    }
    public function identificador(){
        return $this->email;
    }
    public function referencia($referencia)
    {   
        if($referencia=='user_fk')
            return 'id';
    }
}
