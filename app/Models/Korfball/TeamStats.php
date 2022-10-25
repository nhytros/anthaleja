<?php

namespace App\Models\Korfball;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class TeamStats extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'korfball_statistics';
    protected $fillable = [];
}
