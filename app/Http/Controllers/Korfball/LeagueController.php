<?php

namespace App\Http\Controllers\Korfball;

use Illuminate\Http\Request;
use App\Models\Korfball\Game;
use App\Models\Korfball\Team;
use App\Models\Korfball\League;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Korfball\LeagueStore;

class LeagueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $leagues = auth()->user()->character->leagues;
        return view('korfball.leagues.index', compact('leagues'));
    }

    public function reset(Team $teams, Request $request)
    {
        $league = $request->league;
        $teams->reset($league);
        return back();
    }

    public function create()
    {
        return view('korfball.league.create');
    }

    public function store(LeagueStore $request)
    {
        $league = League::create([
            'owner_id' => auth()->user()->character->id,
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return Redirect::route('korfball.leagues')
            ->withSuccess('korfball.league.created');
    }

    public function show(League $league)
    {
        $this->authorize('update', $league);
        $array = json_decode($league->teams, true);
        $members = array_column($array, 'name');

        function scheduler($members)
        {
            if (count($members) % 2 != 0) {
                array_push($members, 'slobodan');
            }
            $away = array_splice($members, (count($members) / 2));
            $home = $members;
            for ($i = 0; $i < count($home) + count($away) - 1; $i++) {
                for ($j = 0; $j < count($home); $j++) {
                    $round[$i][$j]['Home'] = $home[$j];
                    $round[$i][$j]['Away'] = $away[$j];
                }
                if (count($home) + count($away) - 1 > 2) {
                    array_unshift($away, current(array_splice($home, 1, 1)));
                    array_push($home, array_pop($away));
                }
            }
            if (isset($round)) {
                return $round;
            }
        }
        $schedule = scheduler($members);

        $team = $league->teams;

        $sorted = $league->teams()
            ->orderBy('total_points', 'desc')
            ->selectRaw('*, total_korfs_scored-total_korfs_conceded as total')
            ->orderBy('total', 'desc')
            ->orderBy('total_korfs_scored', 'desc')
            ->get();
        $league_id = $league->id;
        $games = new Game;
        $matches = $games->showGames($league_id);
        return view('korfball.leagues.show', compact('sorted', 'league', 'schedule', 'ganes', 'matches'));
    }

    public function edit(League $league)
    {
        $this->authorize('update', $league);
        return view('korfball.leagues.edit', compact('league'));
    }

    public function update(LeagueStore $request, League $league)
    {
        $this->authorize('update', $league);
        $league->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return Redirect::route('korfball.leagues')
            ->withSuccess('korfball.league.updated');
    }

    /**
     * Remove temporarily the specified league.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function delete($slug)
    {
        $league = league::where('slug', $slug)->first();
        $league->delete();
        return back()->withSuccess(trans('korfball.league.deleted'));
    }

    /**
     * Restore the specified league.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function restore($slug)
    {
        $league = league::withTrashed()->where('slug', $slug)->first();
        $league->restore();
        return back()->withSuccess(trans('korfball.league.restored'));
    }

    /**
     * Remove permanently the specified league.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $league = league::withTrashed()->where('slug', $slug)->first();
        $league->forceDelete();
        return back()->withSuccess(trans('korfball.league.destroyed'));
    }
}
