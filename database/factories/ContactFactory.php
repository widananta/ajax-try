<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'email' => $faker->unique()->safeEmail,
    ];
});
