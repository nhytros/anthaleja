<?php

namespace App\Models\Auth;

use App\Models\Market\Vendor;
use App\Models\Market\VendorBank;
use App\Models\Market\VendorBD;
use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Character extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'characters';
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'username', 'gender', 'height', 'date_of_birth', 'bank_account', 'bank_amount', 'cash', 'metals', 'has_phone', 'phone_no', 'avatar', 'thirst', 'hunger', 'energy', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function leagues()
    {
        return $this->hasMany(League::class, 'owner_id');
    }
}
