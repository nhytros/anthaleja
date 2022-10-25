<?php

namespace App\Models\Korfball;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Player extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    public $table = 'korfball_players';
    protected $fillable = ['first_name', 'last_name', 'slug', 'gender', 'photo'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['first_name', 'last_name'])
            ->saveSlugsTo('slug');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
