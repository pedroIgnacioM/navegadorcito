<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MatriculaInstanciaCursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');
        
        foreach (range(1,10) as $alumno) {
            $i_instanciaCurso=0;
            foreach (range(1,5) as $index) { 
                $i_instanciaCurso++;
                DB::table('matriculainstanciacurso')->insert([
                    'rut_fk'=>$alumno*100,
                    'estado_fk'=>'1',
                    'nota'=>null,
                    'instanciaCurso_fk'=>$i_instanciaCurso,
                ]);
            }
            foreach (range(1,5) as $index) {
                if($i_instanciaCurso%2==0)
                {
                    $estado=2;
                    $nota = $faker->numberBetween($min = 40, $max = 70);
                }
                else
                {
                    $estado=3;
                    $nota = $faker->numberBetween($min = 10, $max = 39);
                }
                $i_instanciaCurso++;
                DB::table('matriculainstanciacurso')->insert([
                    'rut_fk'=>$alumno*100,
                    'estado_fk'=>$estado,
                    'nota'=>$nota,
                    'instanciaCurso_fk'=>$i_instanciaCurso,
                ]);
            }
        }
    }
}
