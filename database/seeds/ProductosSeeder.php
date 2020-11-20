<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\producto;


class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(producto::class, 100)->create();
    }
}
