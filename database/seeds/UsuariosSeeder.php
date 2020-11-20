<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'dulce',
            'email'=>'dulcejazmin2403@gmail.com',
            'password' => Hash::make('0705161909'),
            'permiso'=>'1',
            'persona'=>'1'
        ]);
        factory(User::class,100)->create();
    }
}
