<?php

namespace App\Models\Korfball;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class League extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'korfball_leagues';
    protected $fillable = [];

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

    public function owner()
    {
        return $this->belongsTo(Character::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function addTeam($team)
    {
        $this->teams()->create($team);
    }
}
