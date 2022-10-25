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
        'meta_title', 'meta_description', 'meta_keywords', 'is_featured', 'status'
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

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
