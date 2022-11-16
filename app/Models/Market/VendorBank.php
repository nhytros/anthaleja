<?php

namespace App\Models\Market;

use App\Models\Auth\Character;
use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class VendorBank extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'market_vbank';
    protected $fillable = ['vendor_id', 'bank_account', 'bank_amount', 'status'];
}
