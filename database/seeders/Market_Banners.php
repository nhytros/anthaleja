<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Market\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Market_Banners extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($b = 1; $b <= rand(6, 12); $b++) {
            $type = $faker->randomElement(['slide', 'fix']);
            if ($type == 'slide') {
                $width = 1920;
                $height = 400;
            } else {
                $width = 1024;
                $height = 200;
            }

            Banner::create([
                'image' => $faker->imageUrl($width, $height, null, true, $b, false, 'png'),
                'type' => $type,
                'link' => 'any_internal_links',
                'title' => $faker->sentence(6, true),
                'alt' => $faker->sentence(6, true),
                'status' => true,
            ]);
        }
    }
}
