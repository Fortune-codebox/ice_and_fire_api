<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'isbn' => '234-45644643',
        'authors' => 'adam shom',
        'number_of_pages' => 123,
        'publisher' => 'The Mob',
        'country' => $faker->country,
        'release_date' => '2010-23-23'
    ];
});
