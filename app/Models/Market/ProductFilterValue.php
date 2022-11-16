<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class ProductFilterValue extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'market_product_filter_values';
    public $timestamps = false;
    protected $fillable = ['filter_id', 'value', 'status'];
}
