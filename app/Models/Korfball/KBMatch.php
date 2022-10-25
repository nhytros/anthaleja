<?php

namespace App\Models\Korfball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class KBMatch extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'korfball_matches';
    public $timestamps = false;
    protected $fillable = [];
}
