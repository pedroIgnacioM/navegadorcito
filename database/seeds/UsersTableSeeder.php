<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');
    	foreach (range(1,10) as $index) {
	        DB::table('users')->insert([
	            'name' => $faker->userName,
	            'email' => $faker->email,
                'password' => bcrypt('secret'),
                'type' =>'alumno'
            ]);
            
        }
        foreach (range(1,10) as $index) {
            DB::table('users')->insert([
                'name' => $faker->userName,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'type' =>'profesor'
            ]);
        }

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('abc123456'),
            'type' =>'admin'
        ]);
        foreach (range(1,5) as $index) {
            DB::table('users')->insert([
                'name' => $faker->userName,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'type' =>'profesor'
            ]);
        }
        foreach (range(1,5) as $index) {
	        DB::table('users')->insert([
	            'name' => $faker->userName,
	            'email' => $faker->email,
                'password' => bcrypt('secret'),
                'type' =>'alumno'
            ]);
            
        }
    }
}
