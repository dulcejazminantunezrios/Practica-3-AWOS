<?php
use App\Model;
use App\persona;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */


$factory->define(persona::class, function (Faker $faker) {
    return [
        'nombre'=> $faker->unique()->name,
        'apellidos'=> $faker->lastName(),
        'correo'=> $faker-> unique()->safeEmail,
        'edad'=> $faker -> numberBetween(1, 99),
    ];
});
