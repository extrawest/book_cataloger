<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(
    Book::class, function (Faker $faker) {
        return [
            'title' => $faker->title,
            'publisher_id'  =>  $faker->biasedNumberBetween(1, 50),
            'user_id'   =>  $faker->biasedNumberBetween(1, 50),
            'isbn'  =>  $faker->biasedNumberBetween(1111, 9999),
            'count_of_pages' =>  $faker->biasedNumberBetween(100, 500)
        ];
    }
);
