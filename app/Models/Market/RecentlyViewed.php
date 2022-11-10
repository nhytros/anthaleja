<?php

namespace App\Models\Market;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class RecentlyViewed extends Model
{
    use HasFactory, SoftDeletes;

    public $table='';
    protected $fillable=[];

}
