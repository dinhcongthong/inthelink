<?php

use App\Models\Order;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(InfluencerHistorySeeder::class);
        // $this->call(UserTableSeeder::class);
        // $this->call(ProductSeeder::class);
        // $this->call(ProductEvaluationSeeder::class);
        // $this->call(OrdersSeeder::class);
        // $this->call(ProductSelectedSeeder::class);
    }
}
