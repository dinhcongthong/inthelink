<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gallery;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'user_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'gallery_id' => Gallery::inRandomOrder()->first('id'), // password
        'identify_thumb_id' => Gallery::inRandomOrder()->first('id'),
        'user_type' => $faker->numberBetween($min = 1, $max = 3),
        'mobile' => $faker->phoneNumber,
        'gender' => $faker->numberBetween($min = 0, $max = 1),
        'birthday' => now(),
        'last_sign_in_at' => 1,
        'password' => bcrypt('secret')
    ];
});
