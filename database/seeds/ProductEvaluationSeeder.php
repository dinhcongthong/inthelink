<?php

use App\Models\ProductEvaluation;
use Illuminate\Database\Seeder;

class ProductEvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductEvaluation::class, 100)->create();
    }
}
