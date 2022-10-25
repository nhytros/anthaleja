<?php

namespace App\Http\Controllers\Admin\Korfball;

use Illuminate\Http\Request;
use App\Models\Korfball\Team;
use App\Models\Korfball\Player;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class PlayerController extends Controller
{
    public function index()
    {
        $players = DB::table('korfball_players')
            ->join('korfball_teams', 'korfball_players.team_id', '=', 'korfball_teams.id')
            ->select(
                'korfball_players.first_name',
                'korfball_players.last_name',
                'korfball_teams.name',
                'korfball_players.id',
                'korfball_players.photo'
            )
            ->get();
        return view('admin.korfball.player_index', compact('players'));
    }

    public function create()
    {
        $teams = Team::all();
        $select = [];
        foreach ($teams as $team) {
            $select[$team->id] = $team->name;
        }
        return view('admin.korfball.player_create', compact('select'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'team_id' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // TODO: Upload photo
        $player = Player::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'photo' => null,
        ]);

        return Redirect::route('admin.korfball.players')
            ->withSuccess(trans('admin.korfball.player.created'));
    }

    public function show($slug)
    {
        $players = DB::table('korfball_players')
            ->join('korfball_teams', function ($join) use ($slug) {
                $join->on('korfball_players.team_id', '=', 'korfball_teams.id')
                    ->where('korfball_players.team_id', $slug);
            })->first();
        return view('admin.korfball.player_show', compact('players'));
    }

    public function edit($slug)
    {
        $player = Player::where('slug', $slug)->firstOrFail();
        $teams = Team::all();
        $select = [];
        foreach ($teams as $team) {
            $select[$team->id] = $team->name;
        }
        return view('admin.korfball.player_edit', compact('player', 'select'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'team_id' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // TODO: If new photo, delete old photo and Upload the new one
        $player = Player::where('slug', $slug)->firstOrFail();
        $player->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'photo' => null,
        ]);

        return Redirect::route('admin.korfball.players')
            ->withSuccess(trans('admin.korfball.player.updated'));
    }

    public function delete($slug)
    {
        $player = Player::where('slug', $slug)->first();
        $player->delete();
        return back()->withSuccess(trans('admin.player.deleted'));
    }

    public function restore($slug)
    {
        $player = Player::withTrashed()->where('slug', $slug)->first();
        $player->restore();
        return back()->withSuccess(trans('admin.player.restored'));
    }

    /**
     * Remove permanently the specified player.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $player = Player::withTrashed()->where('slug', $slug)->first();
        // TODO:: Remove the photo
        $player->forceDelete();
        return back()->withSuccess(trans('admin.player.destroyed'));
    }
}
