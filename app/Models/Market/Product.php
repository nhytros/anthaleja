<?php

namespace App\Models\Market;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Product extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    public $table = 'market_products';
    protected $fillable = [
        'section_id', 'category_id', 'brand_id', 'vendor_id',
        'name', 'slug', 'code', 'color', 'price', 'discount', 'promo_price', 'weight',
        'main_image', 'video', 'description', 'is_promo', 'start_promo', 'end_promo',
        'meta_title', 'meta_description', 'meta_keywords', 'is_featured', 'status', 'is_bestseller'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name'])
            ->saveSlugsTo('slug');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public static function getPricePromo($product_id): array
    {
        $pDetails = self::select('price', 'discount', 'category_id')->where('id', $product_id)->first();
        $cDetails = Category::select('discount')->where('id', $pDetails->category_id)->first();
        if ($pDetails->discount > 0) {
            $price_promo = $pDetails->price - ($pDetails->price * $pDetails->discount / 100);
            $discount = $pDetails->discount;
        } elseif ($cDetails->discount > 0) {
            $price_promo = $pDetails->price - ($pDetails->price * $cDetails->discount / 100);
            $discount = $cDetails->discount;
        } else {
            return [];
        }
        return ['price_promo' => $price_promo, 'discount' => $discount];
    }
}
