<?php

namespace App\Models\Market;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class ProductFilter extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    public $table = 'market_product_filters';
    public $timestamps = false;
    protected $fillable = ['cat_ids', 'name', 'slug', 'status'];

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
}
