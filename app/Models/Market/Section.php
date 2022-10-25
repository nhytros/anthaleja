<?php

namespace App\Models\Market;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Section extends Model
{
    public $table = 'market_sections';
    protected $fillable = ['name', 'slug'];

    use HasFactory, SoftDeletes, HasSlug;


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

    public function categories()
    {
        return $this->hasMany(Category::class, 'section_id')->where(['parent_id' => 0, 'status' => true])->with('subcategories');
    }
}
