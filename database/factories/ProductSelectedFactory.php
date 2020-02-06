<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Influencers;
use App\Models\Product;
use App\Models\ProductSelected;
use Faker\Generator as Faker;

$factory->define(ProductSelected::class, function (Faker $faker) {
    return [
        'influencer_id' => 29,
        'product_id' => Product::inRandomOrder()->first('id')
    ];
});
