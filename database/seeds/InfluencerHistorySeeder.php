<?php

use App\Models\InfluencerCommissionHistory;
use Illuminate\Database\Seeder;

class InfluencerHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(InfluencerCommissionHistory::class, 200)->create();
    }
}
