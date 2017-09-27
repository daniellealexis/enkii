<?php

use Faker\Generator as Faker;

$factory->define(App\ListComment::class, function(Faker $faker) {
    return [
        'comment' => $faker->realText(),
        'ip_address' => $faker->ipv4,
    ];
});
