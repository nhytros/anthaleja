<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\Korfball\Team;
use App\Models\Auth\Character;
use App\Models\Korfball\League;
use App\Models\Korfball\Player;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class Korfball extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        League::create(['name' => 'Division A', 'owner_id' => 3]);
        League::create(['name' => 'Division B', 'owner_id' => 12]);
        League::create(['name' => 'Division C', 'owner_id' => 24]);

        $teams = 36;
        for ($t = 1; $t <= $teams; $t++) {
            Team::create([
                'league_id' => rand(1, 3),
                'name' => $name = $faker->cityPrefix() . $faker->city(),
                'logo' => $faker->imageUrl(800, 600, null, true, strtoupper($name), false, 'png'),
                'country' => 'Anthal',
                'flag' => $faker->imageUrl(800, 600, null, true, null, false, 'png'),
            ]);
            for ($pf = 1; $pf <= 7; $pf++) {
                Player::create([
                    'team_id' => $t,
                    'first_name' => $fn = $faker->firstNameFemale(),
                    'last_name' => $ln = $faker->lastName(),
                    'gender' => 'female',
                    'photo' => $faker->imageUrl(800, 600, null, true, strtoupper($fn[0] . $ln[0]), false, 'png'),
                ]);
            }
            for ($pm = 1; $pm <= 7; $pm++) {
                Player::create([
                    'team_id' => $t,
                    'first_name' => $fn = $faker->firstNameMale(),
                    'last_name' => $ln = $faker->lastName(),
                    'gender' => 'male',
                    'photo' => $faker->imageUrl(800, 600, null, true, strtoupper($fn[0] . $ln[0]), false, 'png'),
                ]);
            }
        }
    }
}
