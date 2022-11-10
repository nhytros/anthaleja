<?php

namespace App\Models\Market;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Category extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    public $table = 'market_categories';
    protected $fillable = [
        'name', 'slug', 'image', 'discount', 'description',
        'meta_title', 'meta_description', 'meta_keywords', 'status'
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

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    }

    public static function details($slug)
    {
        $details = self::select('id', 'name', 'slug', 'description')->with(['subcategories' => function ($query) {
            $query->select('id', 'parent_id', 'name', 'slug');
        }])->where('slug', $slug)->first();
        $cIDs[] = $details->id;
        foreach ($details->subCategories as $key => $sub) {
            $cIDs[] = $sub->id;
        }
        if ($details->parent_id == 0) {
            $breadcrumb = '<li class="breadcrumb-item" active" aria-current="page"><a href="' . route('market.category', $details->slug) . '">' . $details->name . '</a></li>';
        } else {
            $parent = Category::select('name', 'slug')->where('id', $details->parent_id)->first();
            $breadcrumb = '<li class="breadcrumb-item"><a href="' . route('market.category', $details->slug) . '">' . $details->name . '</a></li>';
            $breadcrumb .= '<li class="breadcrumb-item active" aria-current="page"><a href="' . route('market.category', $parent->slug) . '">' . $parent->name . '</a></li>';
        }
        // return ['cIDs' => $cIDs, 'details' => $details, 'breadcrumb' => $breadcrumb];
        return compact('cIDs', 'details', 'breadcrumb');
    }
}
