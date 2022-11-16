<?php

namespace App\Http\Controllers\Korfball;

use Illuminate\Http\Request;
use App\Models\Korfball\Team;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('league')->get();
        // dd($teams);
        return view('korfball.teams.index', [
            'teams' => $teams,
        ]);
    }
}
