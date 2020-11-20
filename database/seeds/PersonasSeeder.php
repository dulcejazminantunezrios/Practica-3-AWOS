<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\persona;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personas')->insert([
            'nombre'=>  'Dulce Jazmin',
            'apellidos'=>'Antúnez Rios',
            'correo'=>  'dulcejazmin2403@gmail.com',
            'edad'=>     19
        ]);
        factory(persona::class, 100)->create();
    }
}
