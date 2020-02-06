<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\InfluencerCommissionHistory;
use App\Models\Influencers;
use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(InfluencerCommissionHistory::class, function (Faker $faker) {
    return [
        'influencer_id' => 5,
        'order_id' => Order::inRandomOrder()->first('id'),
        'commission' => 5000,
        'updated_at' => now(),
    ];
});
