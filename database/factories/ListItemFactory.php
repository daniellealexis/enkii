<?php

use Faker\Generator as Faker;

$images = [
    'http://fillmurray.com/200/300',
    'http://fillmurray.com/g/200/300',
    'http://www.placecage.com/200/300',
    'http://www.placecage.com/g/200/300',
    'http://www.placecage.com/c/200/300',
    'http://www.placecage.com/gif/200/300',
    'http://lorempixel.com/400/200',
];

$factory->define(App\ListItem::class, function(Faker $faker) use ($images) {
    return [
        'title' => $faker->realText(rand(10, 20)),
        'resource_url' => $faker->url,
        'description' => $faker->realText(),
        'image_url' => $images[array_rand($images)],
        'index' => 1,
    ];
});

