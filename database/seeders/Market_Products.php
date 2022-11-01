<?php

namespace Database\Seeders;

use App\Models\Auth\User;
use Faker\Factory as Faker;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\Section;
use App\Models\Market\Category;
use App\Models\Market\ProductAttribute;
use App\Models\Market\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Market_Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $sections = Section::all();
        $brands = Brand::count();
        $vendor_ids = User::role('vendor')->pluck('id');
        for ($p = 1; $p <= 288; $p++) {
            $section_id = $faker->numberBetween(1, $sections->count());
            $cids = Category::where('section_id', $section_id)->get();
            $cidArray = [];
            foreach ($cids as $cid) {
                array_push($cidArray, $cid->id);
            }
            $randStart = rand(1, 7);
            $randEnd = rand($randStart, 24);
            $start = $faker->dateTimeInInterval('+' . $randStart . ' Days', '+' . $randEnd . ' Days');
            $end = $faker->dateTimeInInterval('+' . $randEnd + 1 . ' Days', '+' . $randEnd + 24 . ' Days');
            $product = Product::create([
                'section_id' => $section_id,
                'category_id' => $faker->randomElement($cidArray),
                'brand_id' => $faker->numberBetween(1, $brands),
                'vendor_id' => $faker->randomElement($vendor_ids),
                'name' => $name = 'Product #' . $p,
                'code' => $faker->unique()->ean8(),
                'color' => $faker->safeColorName(),
                'price' => $price = $faker->numberBetween(500, 10000) / 100,
                'is_promo' => $isPromo = $faker->boolean(10),
                'start_promo' => $isPromo ? $start : null,
                'discount' => $discount = $isPromo ? $faker->numberBetween(1, 5) * 5 : null,
                'weight' => $faker->numberBetween(0, 10000) / 100,
                'main_image' => $faker->imageUrl(800, 600, null, true, $p, false, 'png'),
                'video' => $faker->boolean(20) ? '5Peo-ivmupE' : null,
                'description' => $faker->paragraphs(6, true),
                'meta_title' => $name,
                'meta_description' => $faker->sentence(),
                'meta_keywords' => $faker->words(12, true),
                'is_featured' => $isPromo ? $faker->boolean(50) : false,
                'status' => true,
                'is_bestseller' => $faker->numberBetween(1, 200) > 100 ? true : false,
                'created_at' => $faker->dateTimeBetween('-1 month', '-1 day')
            ]);
            if ($product->category_id >= 13 || $product->category_id <= 19) {
                $sizes = ['XS' => .80, 'S' => .90, 'M' => 1, 'L' => 1.10, 'XL' => 1.20, 'XXL' => 1.30];
                $mult = $faker->randomElement($sizes);
                $size = array_keys($sizes, $mult);
                $price = $product->price_promo ? $product->price_promo * $mult : $product->price * $mult;
                $prod_attr = ProductAttribute::create([
                    'product_id' => $product->id,
                    'sku' => $product->code . '-' . $size[0],
                    'size' => $size[0],
                    'price' => $price,
                    'stock' => $faker->numberBetween(1, 12),
                    'status' => true,
                ]);
            }
            for ($i = 1; $i <= rand(3, 6); $i++) {
                $images = ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $faker->imageUrl(800, 600, null, true, $product->id . '-' . $i, false, 'png'),
                    'status' => 1,
                ]);
            }
        }
    }
}
