<?php

namespace App\Models\Market;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class ProductImage extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'market_product_images';
    protected $fillable = ['product_id', 'image', 'status'];
}
