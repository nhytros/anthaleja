<?php

namespace Database\Seeders;

use App\Models\Market\ProductFilter;
use App\Models\Market\ProductFilterValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Market_ProductsFilters extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        ProductFilter::create(['name' => 'Origin']);
        ProductFilter::create(['name' => 'Cat.']);
        ProductFilter::create(['name' => 'Dealer']);
        ProductFilter::create(['name' => 'Status']);
        ProductFilter::create(['name' => 'Operating System']);
        ProductFilter::create(['name' => 'Ergonomica']);
        ProductFilter::create(['name' => 'Impermeabile']);
        ProductFilter::create(['name' => 'Pieghevole']);
        ProductFilter::create(['name' => 'Retroilluminata']);
        ProductFilter::create(['name' => 'Ricaricabile']);
        ProductFilter::create(['name' => 'Tasti di scelta rapida e tasti multimediali']);
        ProductFilter::create(['name' => 'Trackpad']);
        ProductFilter::create(['name' => 'Bluetooth']);
        ProductFilter::create(['name' => 'Micro USB']);
        ProductFilter::create(['name' => 'Mini USB']);
        ProductFilter::create(['name' => 'PS/2']);
        ProductFilter::create(['name' => 'RF']);
        ProductFilter::create(['name' => 'USB-A']);
        ProductFilter::create(['name' => 'USB-C']);
        ProductFilter::create(['name' => 'AZERTY']);
        ProductFilter::create(['name' => 'QWERTY']);
        ProductFilter::create(['name' => 'QWERTZ']);

        ProductFilterValue::create(['filter_id' => 1, 'value' => 'Anthal']);
        ProductFilterValue::create(['filter_id' => 2, 'value' => 'I']);
        ProductFilterValue::create(['filter_id' => 2, 'value' => 'II']);
        ProductFilterValue::create(['filter_id' => 2, 'value' => 'III']);

        for ($v = 1; $v <= 20; $v++) {
            ProductFilterValue::create(['filter_id' => 1, 'value' => $faker->unique()->country()]);
            ProductFilterValue::create(['filter_id' => 2, 'value' => $faker->unique()->countryISOAlpha3()]);
            ProductFilterValue::create(['filter_id' => 3, 'value' => $faker->unique()->company()]);
        }

        ProductFilterValue::create(['filter_id' => 4, 'value' => 'New']);
        ProductFilterValue::create(['filter_id' => 4, 'value' => 'Used']);
        ProductFilterValue::create(['filter_id' => 4, 'value' => 'Refurbished']);
        ProductFilterValue::create(['filter_id' => 5, 'value' => 'Android']);
        ProductFilterValue::create(['filter_id' => 5, 'value' => 'Linux']);
        ProductFilterValue::create(['filter_id' => 5, 'value' => 'Windows']);
        ProductFilterValue::create(['filter_id' => 5, 'value' => 'IOS']);
        ProductFilterValue::create(['filter_id' => 5, 'value' => 'Blackberry']);
        ProductFilterValue::create(['filter_id' => 5, 'value' => 'Symbian']);
    }
}
