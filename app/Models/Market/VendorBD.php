<?php

namespace App\Models\Market;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class VendorBD extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'market_vbd';
    protected $fillable = [
        'vendor_id', 'shop_name', 'shop_address',
        'shop_phone', 'shop_website', 'shop_email',
        'address_proof', 'address_proof_image', 'licence_code', 'status'
    ];
}
