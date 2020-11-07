<?php

use Illuminate\Database\Seeder;
use App\MatriculaInstanciaCurso;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AlumnoTableSeeder::class,
            CursoTableSeeder::class,
            EstadoMatriculaTableSeeder::class,
            ProfesorTableSeeder::class,
            InstanciaCursoTableSeeder::class,
            MatriculaInstanciaCursoTableSeeder::class
        ]);

    }
}
