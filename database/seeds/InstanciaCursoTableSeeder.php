<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InstanciaCursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');
        $i=10;
        $siglas = ['ICI3242','EST3156','FIS3156','ICI3140','INF3212','ICI3242','EST3156','FIS3156','ICI3140','INF3212'];
        $agnos = ['2018','2018','2018','2018','2018','2017','2017','2016','2016','2016'];

        foreach ($this->myCombinedArray($siglas,$agnos) as $sigla=>$agno) {
            $i++;
            if($i%2==0)
                $semestre='segundo';
            else
                $semestre='primero';
            if($agno=='2018')
                $semestre='primero';
            DB::table('instanciacurso')->insert([
                'agno' => $agno,
                'semestre' => $semestre,
                'siglaCurso_fk' => $sigla,
                'profesor_fk' => $i*100,
                ]);
        }
        

    }
    public function myCombinedArray($keys, $values) {
        foreach($values as $index => $value) {
            yield $keys[$index] => $value;
        }
    }
}
