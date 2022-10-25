<?php

namespace App\Policies;

use App\Models\Auth\Character;
use App\Models\Korfball\{Team, League};
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the character can update the team.
     *
     * @param  Character  $character
     * @param  Team       $team
     * @return mixed
     */
    public function update(Character $character, Team $team)
    {
        $leagueId = $team->league_id;
        $league = new League;
        $owner_id = $league->where('id', $leagueId)->first()->owner->id;

        return $owner_id == $character->id;
    }
}
