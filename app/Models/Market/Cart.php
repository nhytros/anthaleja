<?php

namespace App\Models\Market;

use App\Models\Auth\Character;
use Illuminate\Database\Eloquent\{Model};
use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public $table = 'market_carts';
    protected $fillable = ['session_id', 'character_id', 'product_id', 'size', 'quantity'];

    public static function cartItems()
    {
        $ch = Character::select('id')->where('user_id', auth()->id())->firstOrFail();
        return self::with('product')->where(['character_id' => $ch->id])->orderBy('id', 'desc')->get();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
