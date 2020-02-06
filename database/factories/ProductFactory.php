<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Categories;
use App\Models\Product;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'author_id' => User::inRandomOrder()->first(),
        'category_id' => Categories::inRandomOrder()->first(),
        'price' => $faker->randomDigit,
        'description' => $faker->text,
        'content' => $faker->text,
    ];
});
