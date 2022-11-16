<?php

namespace App\Models\Market;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model};

class ProductAttribute extends Model
{
    use HasFactory;

    public $table = 'market_product_attributes';
    public $timestamps = false;
    protected $fillable = ['product_id', 'sku', 'size', 'price', 'status'];
}
