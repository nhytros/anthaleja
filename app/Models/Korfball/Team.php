<?php

namespace App\Models\Korfball;

use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\{HasSlug, SlugOptions};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Team extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    public $table = 'korfball_teams';
    protected $fillable = ['name', 'slug'];

    public function leagues()
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'home_team', 'away_team');
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function updateTableHomeWin($game)
    {
        extract($game);
        $this->where('id', $homeTeam)->where('league_id', $league)->update([
            'total_points' => DB::raw('total_points + 3'),
            'total_korfs_scored' => DB::raw('total_korfs_scored +' . (int) $homeTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded +' . (int) $awayTeamKorfs),
            'total_games_played' => DB::raw('total_games_played + 1'),
            'total_wins' => DB::raw('total_wins + 1')
        ]);

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
            'total_korfs_scored' => DB::raw('total_korfs_scored +' . (int) $awayTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded +' . (int) $homeTeamKorfs),
            'total_games_played' => DB::raw('total_games_played + 1'),
            'total_loses' => DB::raw('total_loses + 1')
        ]);
    }

    public function updateTableAwayWIn($game)
    {
        extract($game);

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
            'total_points' => DB::raw('total_points + 3'),
            'total_korfs_scored' => DB::raw('total_korfs_scored +' . (int) $awayTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded +' . (int) $homeTeamKorfs),
            'total_games_played' => DB::raw('total_games_played + 1'),
            'total_wins' => DB::raw('total_wins + 1')
        ]);

        $this->where('id', $homeTeam)->where('league_id', $league)->update([
            'total_korfs_scored' => DB::raw('total_korfs_scored +' . (int) $homeTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded +' . (int) $awayTeamKorfs),
            'total_games_played' => DB::raw('total_games_played + 1'),
            'total_loses' => DB::raw('total_loses + 1')
        ]);
    }

    public function updateTableDraw($game)
    {
        extract($game);

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
            'total_points' => DB::raw('total_points + 1'),
            'total_korfs_scored' => DB::raw('total_korfs_scored +' . (int) $awayTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded +' . (int) $homeTeamKorfs),
            'total_games_played' => DB::raw('total_games_played + 1'),
            'total_draws' => DB::raw('total_draws + 1')
        ]);

        $this->where('id', $homeTeam)->where('league_id', $league)->update([
            'total_points' => DB::raw('total_points + 1'),
            'total_korfs_scored' => DB::raw('total_korfs_scored +' . (int) $homeTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded +' . (int) $awayTeamKorfs),
            'total_games_played' => DB::raw('total_games_played + 1'),
            'total_draws' => DB::raw('total_draws + 1')
        ]);
    }

    public function deleteUpdateTableHomeWin($game)
    {
        $homeTeam = $game->homeTeam;
        $awayTeam = $game->awayTeam;
        $league = $game->league;
        $homeTeamKorfs =  $game->homeTeamKorfs;
        $awayTeamKorfs = $game->awayTeamKorfs;

        $this->where('id', $homeTeam)->where('league_id', $league)->update([
            'total_points' => DB::raw('total_points - 3'),
            'total_korfs_scored' => DB::raw('total_korfs_scored -' . (int) $homeTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded -' . (int) $awayTeamKorfs),
            'total_games_played' => DB::raw('total_games_played - 1'),
            'total_wins' => DB::raw('total_wins - 1')
        ]);

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
            'total_korfs_scored' => DB::raw('total_korfs_scored -' . (int) $awayTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded -' . (int) $homeTeamKorfs),
            'total_games_played' => DB::raw('total_games_played - 1'),
            'total_loses' => DB::raw('total_loses - 1')
        ]);
    }

    public function deleteUpdateTableAwayWin($game)
    {
        $homeTeam = $game->homeTeam;
        $awayTeam = $game->awayTeam;
        $league = $game->league;
        $homeTeamKorfs =  $game->homeTeamKorfs;
        $awayTeamKorfs = $game->awayTeamKorfs;

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
            'total_points' => DB::raw('total_points - 3'),
            'total_korfs_scored' => DB::raw('total_korfs_scored -' . (int) $awayTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded -' . (int) $homeTeamKorfs),
            'total_games_played' => DB::raw('total_games_played - 1'),
            'total_wins' => DB::raw('total_wins - 1')
        ]);

        $this->where('id', $homeTeam)->where('league_id', $league)->update([
            'total_korfs_scored' => DB::raw('total_korfs_scored -' . (int) $homeTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded -' . (int) $awayTeamKorfs),
            'total_games_played' => DB::raw('total_games_played - 1'),
            'total_loses' => DB::raw('total_loses - 1')
        ]);
    }


    public function reset($league)
    {
        $this->where('league_id', $league)->update([
            'total_points' =>  0, 'total_korfs_scored' => 0, 'total_korfs_conceded' => 0, 'total_games_played' => 0,
            'total_wins' => 0, 'total_loses' => 0, 'total_draws' => 0
        ]);
        $games = new Game;
        $games->where('league', $league)->delete();
    }

    public function deleteUpdateTableDraw($game)
    {
        $homeTeam = $game->homeTeam;
        $awayTeam = $game->awayTeam;
        $league = $game->league;
        $homeTeamKorfs =  $game->homeTeamKorfs;
        $awayTeamKorfs = $game->awayTeamKorfs;

        $this->where('id', $awayTeam)->where('league_id', $league)->update([
            'total_points' => DB::raw('total_points - 1'),
            'total_korfs_scored' => DB::raw('total_korfs_scored -' . (int) $awayTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded -' . (int) $homeTeamKorfs),
            'total_games_played' => DB::raw('total_games_played - 1'),
            'total_draws' => DB::raw('total_draws - 1')
        ]);

        $this->where('id', $homeTeam)->where('league_id', $league)->update([
            'total_points' => DB::raw('total_points - 1'),
            'total_korfs_scored' => DB::raw('total_korfs_scored -' . (int) $homeTeamKorfs),
            'total_korfs_conceded' => DB::raw('total_korfs_conceded -' . (int) $awayTeamKorfs),
            'total_games_played' => DB::raw('total_games_played - 1'),
            'total_draws' => DB::raw('total_draws - 1')
        ]);
    }
}
