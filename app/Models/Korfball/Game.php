<?php

namespace App\Models\Korfball;

use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Game extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'korfball_games';
    protected $fillable = [
        'home_team_id', 'away_team_id', 'league_id',
        'home_team_points', 'away_team_points', 'home_team_name', 'away_team_name'
    ];

    public function owner()
    {
        return $this->belongsTo(Team::class);
    }

    public function newMatch($game)
    {
        $this->create($game);
    }

    public function showGames($league)
    {
        return $this->where('league', $league)->get();
    }
}
