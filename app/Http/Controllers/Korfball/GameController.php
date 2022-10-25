<?php

namespace App\Http\Controllers\Korfball;

use Illuminate\Http\Request;
use App\Models\Korfball\Game;
use App\Models\Korfball\Team;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function index(Request $request, Game $game)
    {
        $league = $request->league;
        $games = $game->showGames($league);
        return view('korfball.games.index', [
            'games' => $games,
        ]);
    }

    public function store(Request $request, Team $team, Game $game)
    {
        $game = $this->validateGameResult();
        $game = $request->all();

        // Create separate variables from $game array
        extract($game);
        $homeTeamName = $homeTeam;
        $awayTeamName = $awayTeam;

        $homeTeam = $team->select('id')->where('name', $homeTeam)->get();
        $homeTeam = $homeTeam[0]['id'];

        $awayTeam = $team->select('id')->where('name', $awayTeam)->get();
        $awayTeam = $awayTeam[0]['id'];

        // Checks if the game exists, if it dows it redirects and ask delete/abort
        if ($games->where('home_tean', $homeTeam)->where('away_team', $awayTeam)->first()) {
            $match = $games->where('home_team', $homeTeam)->where('away_team', $awayTeam)->get();
            $match[0]['home'] = $homeTeamName;
            $match[0]['away'] = $awayTeamName;
            return 2;
            return view('korfball.games.show', compact('match'));
        }

        $game['home_team_name'] = $homeTeamName;
        $game['away_team_name'] = $awayTeamName;
        $game['home_team'] = $homeTeam;
        $game['away_team'] = $awayTeam;

        // Creates new game in games table
        $games->newMatch($game);

        // Update teams stats in teams table (totalPoints, totalKorfsScored, etc.)
        if ($homeTeamKorfs > $awayTeamKorfs) {
            $team->updateTableHomeWin($game);
        } elseif ($awayTeamKorfs > $homeTeamKorfs) {
            $team->updateTableAwayWin($game);
        }
        if ($awayTeamKorfs == $homeTeamKorfs) {
            $team->updateTableDraw($game);
        }
        return back();
    }

    public function destroy(Game $game, Request $request, Team $team)
    {
        if ($game->home_team_korfs > $game->away_team_korfs) {
            $team->deleteUpdateTableHomeWin($game);
        }

        if ($game->home_team_korfs < $game->away_team_korfs) {
            $team->deleteUpdateTableAwayWin($game);
        }

        if ($game->home_team_korfs == $game->away_team_korfs) {
            $team->deleteUpdateTableDraw($game);
        }
        $game->delete();
        return back()->withSuccess(trans('korfball.game.deleted'));
    }

    public function validateGameResult()
    {
        return request()->validate([
            'home_teams_korfs' => ['required', 'numeric'],
            'away_teams_korfs' => ['required', 'numeric'],
        ]);
    }
}
