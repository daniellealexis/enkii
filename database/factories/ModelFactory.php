<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

static $images = [
    'http://fillmurray.com/200/300',
    'http://fillmurray.com/g/200/300',
    'http://www.placecage.com/200/300',
    'http://www.placecage.com/g/200/300',
    'http://www.placecage.com/c/200/300',
    'http://www.placecage.com/gif/200/300',
    'http://lorempixel.com/400/200',
];

$factory->define(App\Lists::class, function(Faker\Generator $faker) use ($images) {
    static $type = ['ol', 'ul'];

    return [
        'title' => $faker->realText(rand(10, 20)),
        'description' => $faker->realText(),
        'image_url' => $images[array_rand($images)],
        'type' => $type[array_rand($type)],
    ];
});

$factory->define(App\ListItem::class, function(Faker\Generator $faker) use ($images) {
    return [
        'title' => $faker->realText(rand(10, 20)),
        'resource_url' => $faker->url,
        'description' => $faker->realText(),
        'image_url' => $images[array_rand($images)],
        'index' => 1,
    ];
});