<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\Market\Brand;
use Illuminate\Database\Seeder;

class Market_Brands extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($b = 1; $b <= 48; $b++) {
            Brand::create(['name' => ucfirst($faker->unique()->word())]);
        }
    }
}
