<?php

namespace App\Models\Market;

use App\Models\Auth\Character;
use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    public $table = 'market_vendors';
    protected $fillable = ['character_id', 'status'];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function vbank()
    {
        return $this->hasOne(VendorBank::class);
    }

    public function vdetails()
    {
        return $this->hasOne(VendorBD::class);
    }
}
