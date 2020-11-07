<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AlumnoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');
        $i=0;
    	foreach (range(1,10) as $index) {
            $i++;
	        DB::table('alumno')->insert([
	            'nombres' => $faker->name,
	            'rut' => $i*100,
                'apellido_paterno' => $faker->lastName,
                'apellido_materno' => $faker->lastName,
                'user_fk' => $i,
            ]);
        }
    }
}
