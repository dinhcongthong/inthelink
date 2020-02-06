<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Influencers;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first('id'),
        'influencer_id' => Influencers::inRandomOrder()->first('id'),
        'product_id' => Product::inRandomOrder()->first('id'),
        'quantity' => $faker->numberBetween($min = 1, $max = 6),
        'status' => $faker->numberBetween($min = 0, $max = 1),
        'total_amount' => $faker->randomDigit,
        'payment_method' => $faker->numberBetween($min = 1, $max = 3),
        'note' => $faker->text,
        'created_at' => now(),
        'updated_at' => now()
    ];
});
