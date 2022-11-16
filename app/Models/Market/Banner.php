<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'market_banners';
    protected $fillable = ['image', 'title', 'alt', 'status'];
}
