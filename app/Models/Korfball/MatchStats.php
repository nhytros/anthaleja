<?php

namespace App\Models\Korfball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchStats extends Model
{
    use HasFactory;

    public $table = 'korfball_match_stats';
    protected $fillable = [];
}
