<?php

namespace App\Http\Controllers\Korfball;

use App\Models\Korfball\Player;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
    public function index()
    {
        // $players = DB::table('korfball_players')->join('korfball_teams', 'korfball_players.team_id', '=', 'korfball_teams.id')->get();
        $players = Player::orderBy('last_name')->get();
        // $players = Player::all();
        return view('korfball.players.index', [
            'players' => $players
        ]);
    }

    public function show($slug)
    {
        $players = Player::join('korfball_teams', function ($join) use ($slug) {
            $join->on('korfball_players.team_id', '=', 'korfball_teams.id')
                ->where('korfball_players.team_id', $slug);
        })->first();
        return view('korfball.players.show', compact('players'));
    }
}
