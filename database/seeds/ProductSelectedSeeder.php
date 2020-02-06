<?php

use App\Models\ProductSelected;
use Illuminate\Database\Seeder;

class ProductSelectedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductSelected::class, 100)->create();
    }
}
