<?php

namespace App\Policies;

use App\Models\Auth\Character;
use App\Models\Korfball\League;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeaguePolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the character can update the league.
     *
     * @param  Character  $character
     * @param  League     $league
     * @return mixed
     */
    public function update(Character $character, League $leagues)
    {
        return $leagues->owner_id == $character->id;
        // return dd($leagues->first()->owner_id);
        // return $character->id == $leagues->first()->owner_id;
    }
}
