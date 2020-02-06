<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Product;
use App\Models\ProductEvaluation;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(ProductEvaluation::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first('id'),
        'product_id' => Product::inRandomOrder()->first('id'),
        'content' => $faker->text,
        'stars_number' => $faker->numberBetween($min = 0, $max = 5),
        'created_at' => now(),
        'updated_at' => now()
    ];
});
