<?php

use Illuminate\Database\Seeder;

class EstadoMatriculaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estadomatricula')->insert([
            'estado'=>'En curso'
        ]);
        DB::table('estadomatricula')->insert([
            'estado'=>'Aprobada'
        ]);
        DB::table('estadomatricula')->insert([
            'estado'=>'Reprobada'
        ]);
    }
}
