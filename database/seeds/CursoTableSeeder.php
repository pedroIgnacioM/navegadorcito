<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $siglas = ['ICI3242','EST3156','FIS3156','ICI3140','INF3212'];
    	foreach ($siglas as $sigla) {
	        DB::table('curso')->insert([
	            'sigla' => $sigla,
	            'nombre' => $faker->jobTitle,
                'descripcion' => $faker->sentence,
            ]);
        }

    }
}
