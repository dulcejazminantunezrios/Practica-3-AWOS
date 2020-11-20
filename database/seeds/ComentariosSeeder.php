<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\comentario;


class ComentariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(comentario::class,100)->create();
    }
}
