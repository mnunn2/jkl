<?php

use Faker\Generator as Faker;

$factory->define(App\Worker::class, function (Faker $faker) {
    return [
        'number' => $faker->unique()->numberBetween(1000, 9000),
        'forename' => $faker->firstName,
        'last_name' => $faker->lastName,
        'type' => 'contract',
        'active' => true,
        'daily_rate' => $faker->numberBetween(10000, 20000),
        //
    ];
});
