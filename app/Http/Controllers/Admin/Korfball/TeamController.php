<?php

namespace App\Http\Controllers\Admin\Korfball;

use Illuminate\Http\Request;
use App\Models\Korfball\Team;
use App\Models\Korfball\Player;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('admin.korfball.team_index', compact('teams'));
    }

    public function create()
    {
        return view('admin.korfball.team_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'flag' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'logo' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // TODO: Upload photo
        Team::create([
            'name' => $request->name,
            'country' => $request->country ?? 'Anthal',
            'flag' => null,
            'logo' => null,
        ]);

        return Redirect::route('admin.korfball.teams')
            ->withSuccess(trans('admin.korfball.team.created'));
    }

    public function show($slug)
    {
        $team = Team::where('slug', $slug)->firstOrFail();
        $id = $team->id;
        $players = DB::table('korfball_players')
            ->join('korfball_teams', function ($join) use ($id) {
                $join->on('korfball_players.team_id', '=', 'korfball_teams.id')
                    ->where('korfball_players.team_id', $id);
            })->get();
        return view('admin.korfball.team_show', compact('team', 'players'));
    }

    public function edit($slug)
    {
        $team = Team::where('slug', $slug)->firstOrFail();
        return view('admin.korfball.team_edit', compact('team'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required',
            'flag' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'logo' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // TODO: If new flag/logo, delete old flag/logo and Upload the new one
        $team = Team::where('slug', $slug)->firstOrFail();
        $team->update([
            'name' => $request->name,
            'country' => $request->country ?? 'Anthal',
            'flag' => null,
            'logo' => null,
        ]);

        return Redirect::route('admin.korfball.teams')
            ->withSuccess(trans('admin.korfball.team.updated'));
    }

    public function delete($slug)
    {
        $team = Team::where('slug', $slug)->first();
        $team->delete();
        return back()->withSuccess(trans('admin.team.deleted'));
    }

    public function restore($slug)
    {
        $team = Team::withTrashed()->where('slug', $slug)->first();
        $team->restore();
        return back()->withSuccess(trans('admin.team.restored'));
    }

    /**
     * Remove permanently the specified team.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $team = Team::withTrashed()->where('slug', $slug)->first();
        // TODO:: Remove the logo/flag
        $team->forceDelete();
        return back()->withSuccess(trans('admin.team.destroyed'));
    }
}
