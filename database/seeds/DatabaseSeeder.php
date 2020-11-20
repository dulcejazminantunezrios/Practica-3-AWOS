<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductosSeeder::class);
        $this->call(PersonasSeeder::class);
        $this->call(ComentariosSeeder::class);
        $this->call(UsuariosSeeder::class);

    }
}
